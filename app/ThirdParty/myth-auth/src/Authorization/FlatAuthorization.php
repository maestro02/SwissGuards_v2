<?php namespace Myth\Auth\Authorization;

use CodeIgniter\Model;
use CodeIgniter\Events\Events;
use Config\Services;

class FlatAuthorization implements AuthorizeInterface
{

    protected $error = null;
    /**
     * @var GroupModel
     */
    protected $groupModel;
    /**
     * @var PermissionModel
     */
    protected $permissionModel;
    /**
     * @var null UserModel
     */
    protected $userModel = null;

    public function __construct(Model $groupModel, Model $permModel)
    {
        $this->groupModel = $groupModel;
        $this->permissionModel = $permModel;
    }

    public function error()
    {
        return $this->error;
    }

    /**
     * Allows the consuming application to pass in a reference to the
     * model that should be used.
     *
     * @param $model
     *
     * @return mixed
     */
    public function setUserModel($model)
    {
        $this->userModel = $model;

        return $this;
    }

    //--------------------------------------------------------------------
    // Actions
    //--------------------------------------------------------------------

    /**
     * Checks to see if a user is in a group.
     *
     * Groups can be either a string, with the name of the group, an INT
     * with the ID of the group, or an array of strings/ids that the
     * user must belong to ONE of. (It's an OR check not an AND check)
     *
     * @param $groups
     *
     * @return bool
     */
    public function inGroup($groups, int $userId)
    {
        if (!is_array($groups)) {
            $groups = [$groups];
        }

        if (empty($userId)) {
            return null;
        }

        $userGroups = $this->groupModel->getGroupsForUser((int)$userId);

        if (empty($userGroups)) {
            return false;
        }

        foreach ($groups as $group) {
            if (is_numeric($group)) {
                $ids = array_column($userGroups, 'group_id');
                if (in_array($group, $ids)) {
                    return true;
                }
            } else {
                if (is_string($group)) {
                    $names = array_column($userGroups, 'name');

                    if (in_array($group, $names)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Checks a user's groups to see if they have the specified permission.
     *
     * @param int|string $permission
     * @param int        $userId
     *
     * @return mixed
     */
    public function hasPermission($permission, int $userId)
    {
        if (empty($permission) || (!is_string($permission) && !is_numeric($permission))) {
            return null;
        }

        if (empty($userId) || !is_numeric($userId)) {
            return null;
        }

        // Get the Permission ID
        $permissionId = $this->getPermissionID($permission);

        if (!is_numeric($permissionId)) {
            return false;
        }

        // First check the permission model. If that exists, then we're golden.
        if ($this->permissionModel->doesUserHavePermission($userId, (int)$permissionId)) {
            return true;
        }

        // Still here? Then we have one last check to make - any user private permissions.
        return $this->doesUserHavePermission($userId, (int)$permissionId);
    }

    /**
     * Verifies that a permission (either ID or the name) exists and returns
     * the permission ID.
     *
     * @param int|string $permission
     *
     * @return int|null
     */
    protected function getPermissionID($permission)
    {
        // If it's a number, we're done here.
        if (is_numeric($permission)) {
            return (int)$permission;
        }

        // Otherwise, pull it from the database.
        $p = $this->permissionModel->asObject()->where('name', $permission)->first();

        if (!$p) {
            $this->error = lang('Auth.permissionNotFound', [$permission]);

            return false;
        }

        return (int)$p->id;
    }

    /**
     * Checks to see if a user has private permission assigned to it.
     *
     * @param $userId
     * @param $permission
     *
     * @return bool|null
     */
    public function doesUserHavePermission($userId, $permission)
    {
        $permissionId = $this->getPermissionID($permission);

        if (!is_numeric($permissionId)) {
            return false;
        }

        if (empty($userId) || !is_numeric($userId)) {
            return null;
        }

        return $this->permissionModel->doesUserHavePermission($userId, $permissionId);
    }

    /**
     * Makes a member a part of a group.
     *
     * @param $userid
     * @param $group // Either ID or name
     *
     * @return bool
     */
    public function addUserToGroup(int $userid, $group)
    {
        if (empty($userid) || !is_numeric($userid)) {
            return null;
        }

        if (empty($group) || (!is_numeric($group) && !is_string($group))) {
            return null;
        }

        $groupId = $this->getGroupID($group);

        if (!Events::trigger('beforeAddUserToGroup', $userid, $groupId)) {
            return false;
        }

        // Group ID
        if (!is_numeric($groupId)) {
            return null;
        }

        if (!$this->groupModel->addUserToGroup($userid, (int)$groupId)) {
            $this->error = $this->groupModel->errors();

            return false;
        }

        Events::trigger('didAddUserToGroup', $userid, $groupId);

        return true;
    }

    /**
     * Given a group, will return the group ID. The group can be either
     * the ID or the name of the group.
     *
     * @param int|string $group
     *
     * @return int|false
     */
    protected function getGroupID($group)
    {
        if (is_numeric($group)) {
            return (int)$group;
        }

        $g = $this->groupModel->where('name', $group)->first();

        if (!$g) {
            $this->error = lang('Auth.groupNotFound', [$group]);

            return false;
        }

        return (int)$g->id;
    }

    /**
     * Removes a single user from a group.
     *
     * @param $userId
     * @param $group
     *
     * @return mixed
     */
    public function removeUserFromGroup(int $userId, $group)
    {
        if (empty($userId) || !is_numeric($userId)) {
            return null;
        }

        if (empty($group) || (!is_numeric($group) && !is_string($group))) {
            return null;
        }

        $groupId = $this->getGroupID($group);

        if (!Events::trigger('beforeRemoveUserFromGroup', $userId, $groupId)) {
            return false;
        }

        // Group ID
        if (!is_numeric($groupId)) {
            return false;
        }

        if (!$this->groupModel->removeUserFromGroup($userId, $groupId)) {
            $this->error = $this->groupModel->errors();

            return false;
        }

        Events::trigger('didRemoveUserFromGroup', $userId, $groupId);

        return true;
    }

    /**
     * Adds a single permission to a single group.
     *
     * @param int|string $permission
     * @param int|string $group
     *
     * @return mixed
     */
    public function addPermissionToGroup($permission, $group)
    {
        $permissionId = $this->getPermissionID($permission);
        $groupId = $this->getGroupID($group);

        // Permission ID
        if (!is_numeric($permissionId)) {
            return false;
        }

        // Group ID
        if (!is_numeric($groupId)) {
            return false;
        }

        // Remove it!
        if (!$this->groupModel->addPermissionToGroup($permissionId, $groupId)) {
            $this->error = $this->groupModel->errors();

            return false;
        }

        return true;
    }

    /**
     * Removes a single permission from a group.
     *
     * @param int|string $permission
     * @param int|string $group
     *
     * @return mixed
     */
    public function removePermissionFromGroup($permission, $group)
    {
        $permissionId = $this->getPermissionID($permission);
        $groupId = $this->getGroupID($group);

        // Permission ID
        if (!is_numeric($permissionId)) {
            return false;
        }

        // Group ID
        if (!is_numeric($groupId)) {
            return false;
        }

        // Remove it!
        if (!$this->groupModel->removePermissionFromGroup($permissionId, $groupId)) {
            $this->error = $this->groupModel->errors();

            return false;
        }

        return true;
    }

    //--------------------------------------------------------------------
    // Groups
    //--------------------------------------------------------------------

    /**
     * Assigns a single permission to a user, irregardless of permissions
     * assigned by roles. This is saved to the user's meta information.
     *
     * @param int|string $permission
     * @param int        $userId
     *
     * @return int|bool
     */
    public function addPermissionToUser($permission, int $userId)
    {
        $permissionId = $this->getPermissionID($permission);

        if (!is_numeric($permissionId)) {
            return null;
        }

        if (!Events::trigger('beforeAddPermissionToUser', $userId, $permissionId)) {
            return false;
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            $this->error = lang('Auth.userNotFound', [$userId]);
            return false;
        }

        $permissions = $user->getPermissions();

        if (!in_array($permissionId, $permissions)) {
            $this->permissionModel->addPermissionToUser($permissionId, $user->id);
        }

        Events::trigger('didAddPermissionToUser', $userId, $permissionId);

        return true;
    }

    /**
     * Removes a single permission from a user. Only applies to permissions
     * that have been assigned with addPermissionToUser, not to permissions
     * inherited based on groups they belong to.
     *
     * @param int/string $permission
     * @param int $userId
     *
     * @return bool|mixed|null
     */
    public function removePermissionFromUser($permission, int $userId)
    {
        $permissionId = $this->getPermissionID($permission);

        if (!is_numeric($permissionId)) {
            return false;
        }

        if (empty($userId) || !is_numeric($userId)) {
            return null;
        }

        $userId = (int)$userId;

        if (!Events::trigger('beforeRemovePermissionFromUser', $userId, $permissionId)) {
            return false;
        }

        return $this->permissionModel->removePermissionFromUser($permissionId, $userId);
    }

    /**
     * Grabs the details about a single group.
     *
     * @param $group
     *
     * @return object|null
     */
    public function group($group)
    {
        if (is_numeric($group)) {
            return $this->groupModel->find((int)$group);
        }

        return $this->groupModel->where('name', $group)->first();
    }

    /**
     * Grabs an array of all groups.
     *
     * @return array of objects
     */
    public function groups()
    {
        return $this->groupModel
            ->orderBy('name', 'asc')
            ->findAll();
    }

    /**
     * @param        $name
     * @param string $description
     *
     * @return mixed
     */
    public function createGroup(string $name, string $description = '')
    {
        $data = [
            'name' => $name,
            'description' => $description,
        ];

        $validation = Services::validation(null, false);
        $validation->setRules([
            'name' => 'required|max_length[255]|is_unique[auth_groups.name]',
            'description' => 'max_length[255]',
        ]);

        if (!$validation->run($data)) {
            $this->error = $validation->getErrors();
            return false;
        }

        $id = $this->groupModel->skipValidation()->insert($data);

        if (is_numeric($id)) {
            return (int)$id;
        }

        $this->error = $this->groupModel->errors();

        return false;
    }

    /**
     * Deletes a single group.
     *
     * @param int $groupId
     *
     * @return bool
     */
    public function deleteGroup(int $groupId)
    {
        if (!$this->groupModel->delete($groupId)) {
            $this->error = $this->groupModel->errors();

            return false;
        }

        return true;
    }

    //--------------------------------------------------------------------
    // Permissions
    //--------------------------------------------------------------------

    /**
     * Updates a single group's information.
     *
     * @param        $id
     * @param        $name
     * @param string $description
     *
     * @return mixed
     */
    public function updateGroup(int $id, string $name, string $description = '')
    {
        $data = [
            'name' => $name,
        ];

        if (!empty($description)) {
            $data['description'] = $description;
        }

        if (!$this->groupModel->update($id, $data)) {
            $this->error = $this->groupModel->errors();

            return false;
        }

        return true;
    }

    /**
     * Returns the details about a single permission.
     *
     * @param int|string $permission
     *
     * @return object|null
     */
    public function permission($permission)
    {
        if (is_numeric($permission)) {
            return $this->permissionModel->find((int)$permission);
        }

        return $this->permissionModel->where('LOWER(name)', strtolower($permission))->first();
    }

    /**
     * Returns an array of all permissions in the system.
     *
     * @return mixed
     */
    public function permissions()
    {
        return $this->permissionModel->findAll();
    }

    /**
     * Creates a single permission.
     *
     * @param        $name
     * @param string $description
     *
     * @return mixed
     */
    public function createPermission(string $name, string $description = '')
    {
        $data = [
            'name' => $name,
            'description' => $description,
        ];

        $validation = Services::validation(null, false);
        $validation->setRules([
            'name' => 'required|max_length[255]|is_unique[auth_permissions.name]',
            'description' => 'max_length[255]',
        ]);

        if (!$validation->run($data)) {
            $this->error = $validation->getErrors();
            return false;
        }

        $id = $this->permissionModel->skipValidation()->insert($data);

        if (is_numeric($id)) {
            return (int)$id;
        }

        $this->error = $this->permissionModel->errors();

        return false;
    }

    /**
     * Deletes a single permission and removes that permission from all groups.
     *
     * @param int $permissionIdId
     *
     * @return mixed
     */
    public function deletePermission(int $permissionIdId)
    {
        if (!$this->permissionModel->delete($permissionIdId)) {
            $this->error = $this->permissionModel->errors();

            return false;
        }

        // Remove the permission from all groups
        $this->groupModel->removePermissionFromAllGroups($permissionIdId);

        return true;
    }

    /**
     * Updates the details for a single permission.
     *
     * @param int    $id
     * @param string $name
     * @param string $description
     *
     * @return bool
     */
    public function updatePermission(int $id, string $name, string $description = '')
    {
        $data = [
            'name' => $name,
        ];

        if (!empty($description)) {
            $data['description'] = $description;
        }

        if (!$this->permissionModel->update((int)$id, $data)) {
            $this->error = $this->permissionModel->errors();

            return false;
        }

        return true;
    }

    /**
     * Returns an array of all permissions in the system for a group
     * The group can be either the ID or the name of the group.
     *
     * @param int|string $group
     *
     * @return mixed
     */
    public function groupPermissions($group)
    {
        if (is_numeric($group)) {
            return $this->groupModel->getPermissionsForGroup($group);
        } else {
            $g = $this->groupModel->where('name', $group)->first();
            return $this->groupModel->getPermissionsForGroup($g->id);
        }
    }

}
