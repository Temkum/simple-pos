<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new UserModel();

    $data_arr['username'] = $_POST['username'];

    // if ($row = $user->where(['username' => $_POST['username']])) {
    if ($row = $user->where($data_arr)) {
        if (password_verify($_POST['pwd'], $row[0]['password'])) {
            authenticate($row);

            redirect('home');
        } else {
            $errors['pwd'] = 'Password is wrong!';
        }
    } else {
        $errors['username'] = 'Wrong username!';
    }
}

require viewsPath('auth/login');