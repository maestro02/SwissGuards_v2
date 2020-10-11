<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class alter_table_users extends Migration
{
    public function up()
    {
        // add additional data to users table
        $fields = [
            'allyCode' => ['type' => 'varchar', 'constraint' => 11],
            'discordId' => ['type' => 'varchar', 'constraint' => 255],
        ];
        $this->forge->addColumn('users', $fields);
        $this->forge->addUniqueKey('allyCode');

        // add additional data to users table
        $fields = [
            'nameEn' => ['type' => 'varchar', 'constraint' => 255],
            'nameDe' => ['type' => 'varchar', 'constraint' => 255],
        ];
        $this->forge->dropColumn('auth_groups', ['name', 'description']);
        $this->forge->addColumn('auth_groups', $fields);

    }

    public function down()
    {
        // drop new columns
        $this->forge->dropColumn('users', 'allyCode');
        $this->forge->dropColumn('users', 'discordId');
    }
}
