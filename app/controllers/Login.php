<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = validate($_POST, 'users');

    $data_arr['username'] = $_POST['username'];

    if ($row = where($data_arr, 'users')) {
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
