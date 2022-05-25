<?php

$errors = [];
$user = new UserModel();

$id = $_GET['id'] ?? null;
$row = $user->getSingle(['id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ensure only admins can create admins
    if (is_array($row) && Auth::access('admin') && $row['deletable']) {
        $user->delete($id);

        redirect('admin&tab=users');
    }
}

if (Auth::access('admin')) {
    require viewsPath('auth/delete_user');
} else {
    Auth::setMessage('You need admin rights to create users!');

    require viewsPath('auth/access');
}