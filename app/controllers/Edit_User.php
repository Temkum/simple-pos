<?php

$errors = [];
$user = new UserModel();

$id = $_GET['id'] ?? null;

$row = $user->getSingle(['id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  $_POST['role'] = 'user';
  $_POST['date'] = date('Y-m-d H:i:s');

  $errors = $user->validate($_POST);

  if (empty($errors)) {
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user->insert($_POST, 'users');

    redirect('home');
  }
}

if (Auth::access('admin')) {
  require viewsPath('auth/edit_user');
} else {
  Auth::setMessage('You need admin rights to create users!');

  require viewsPath('auth/access');
}