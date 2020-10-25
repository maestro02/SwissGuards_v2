<?php

return [
    // Exceptions
    'invalidModel' => 'The {0} model must be loaded prior to use.',
    'userNotFound' => 'Unable to locate a user with ID = {0, number}.',
    'noUserEntity' => 'User Entity must be provided for password validation.',
    'tooManyCredentials' => 'You may only validate against 1 credential other than a password.',
    'invalidFields' => 'The "{0}" field cannot be used to validate credentials.',
    'unsetPasswordLength' => 'You must set the `minimumPasswordLength` setting in the Auth config file.',
    'unknownError' => 'Sorry, we encountered an issue sending the email to you. Please try again later.',
    'notLoggedIn' => 'You must be logged in to access that page.',
    'notEnoughPrivilege' => 'You do not have sufficient permissions to access that page.',

    // Registration
    'registerDisabled' => 'Sorry, new user accounts are not allowed at this time.',
    'registerSuccess' => 'Welcome aboard! Please login with your new credentials.',
    'registerCLI' => 'New user created: {0}, #{1}',

    // Activation
    'activationNoUser' => 'Unable to locate a user with that activation code.',
    'activationSubject' => 'Activate your account',
    'activationSuccess' => 'Please confirm your account by clicking the activation link in the email we have sent.',
    'activationResend' => 'Resend activation message one more time.',
    'notActivated' => 'This user account is not yet activated.',
    'errorSendingActivation' => 'Failed to send activation message to: {0}',

    // Login
    'badAttempt' => 'Unable to log you in. Please check your credentials.',
    'loginSuccess' => 'Welcome back!',
    'invalidPassword' => 'Unable to log you in. Please check your password.',

    // Forgotten Passwords
    'forgotDisabled' => 'Resetting password option has been disabled.',
    'forgotNoUser' => 'Unable to locate a user with that email.',
    'forgotSubject' => 'Password Reset Instructions',
    'resetSuccess' => 'Your password has been successfully changed. Please login with the new password.',
    'forgotEmailSent' => 'A security token has been emailed to you. Enter it in the box below to continue.',
    'errorEmailSent' => 'Unable to send email with password reset instructions to: {0}',

    // Passwords
    'errorPasswordLength' => 'Passwords must be at least {0, number} characters long.',
    'suggestPasswordLength' => 'Pass phrases - up to 255 characters long - make more secure passwords that are easy to remember.',
    'errorPasswordCommon' => 'Password must not be a common password.',
    'suggestPasswordCommon' => 'The password was checked against over 65k commonly used passwords or passwords that have been leaked through hacks.',
    'errorPasswordPersonal' => 'Passwords cannot contain re-hashed personal information.',
    'suggestPasswordPersonal' => 'Variations on your email address or username should not be used for passwords.',
    'errorPasswordTooSimilar' => 'Password is too similar to the username.',
    'suggestPasswordTooSimilar' => 'Do not use parts of your username in your password.',
    'errorPasswordPwned' => 'The password {0} has been exposed due to a data breach and has been seen {1, number} times in {2} of compromised passwords.',
    'suggestPasswordPwned' => '{0} should never be used as a password. If you are using it anywhere change it immediately.',
    'errorPasswordEmpty' => 'A Password is required.',
    'passwordChangeSuccess' => 'Password changed successfully',
    'userDoesNotExist' => 'Password was not changed. User does not exist',
    'resetTokenExpired' => 'Sorry. Your reset token has expired.',

    // Groups
    'groupNotFound' => 'Benutzergruppe nicht gefunden: {0}.',

    // Permissions
    'permissionNotFound' => 'Berechtigung nicht gefunden: {0}',

    // Banned
    'userIsBanned' => 'Benutzer wurde blockiert. Kontaktiere den Administrator.',

    // Too many requests
    'tooManyRequests' => 'Zu viele Anfragen. Bitte warte {0, number} Sekunden.',

    // Login views
    'home' => 'Home',
    'current' => 'Current',
    'forgotPassword' => 'Passwort vergessen?',
    'enterEmailForInstructions' => 'Kein Problem! Gib deine E-Mail-Adresse ein und du erhältst per Mail weitere Informationen zum Zurücksetzen deines Passworts.',
    'email' => 'E-Mail',
    'emailAddress' => 'E-Mail-Adresse',
    'sendInstructions' => 'E-Mail senden',
    'loginTitle' => 'Anmeldung',
    'loginAction' => 'Anmelden',
    'rememberMe' => 'Login merken',
    'needAnAccount' => 'Noch keinen Account?',
    'forgotYourPassword' => 'Passwort vergessen?',
    'password' => 'Passwort',
    'repeatPassword' => 'Passwort wiederholen',
    'emailOrUsername' => 'E-Mail oder Benutzername',
    'username' => 'Benutzername',
    'register' => 'Registrieren',
    'signIn' => 'Anmelden',
    'alreadyRegistered' => 'Bereits registriert?',
    'weNeverShare' => 'Deine Daten wird niemals weitergegeben.',
    'resetYourPassword' => 'Passwort zurücksetzen',
    'enterCodeEmailPassword' => 'Gib den per E-Mail erhaltenen Code, deine E-Mail-Adresse und dein neues Passwort ein.',
    'token' => 'Token',
    'newPassword' => 'Neues Passwort',
    'newPasswordRepeat' => 'Neues Passwort wiederholen',
    'resetPassword' => 'Passwort zurücksetzen',
    'allyCode' => 'Deinen SWGOH-Verbündetencode (Allycode)',
    'discordId' => 'Deine Discord-ID',
];
