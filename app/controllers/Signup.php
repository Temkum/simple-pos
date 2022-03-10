<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new UserModel();
    
    $_POST['role'] = 'user';
    $_POST['date'] = date('Y-m-d H:i:s');

    $errors = $user->validate($_POST);

    if (empty($errors)) {
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user->insert($_POST, 'users');

        redirect('home');
    }
}

require viewsPath('auth/signup');