<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = validate($_POST, 'users');

    $data_arr['email'] = $_POST['email'];

    if ($row = where($data_arr, 'users')) {
        if ($row[0]['password'] === $_POST['password']) {
            authenticate($row);

            redirect('home');
        } else {
            $errors['password'] = 'Password is wrong!';
        }
    } else {
        $errors['email'] = 'Email is wrong!';
    }
}

require viewsPath('auth/login');
