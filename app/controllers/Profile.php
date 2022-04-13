<?php

$errors = [];
$user = new UserModel();

$id = $_GET['id'] ?? Auth::getUserData('id');

$row = $user->getSingle(['id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // ensure only admins can create admins
  if ($_POST['role'] == 'admin') {

    if (!Auth::getUserData('role') == 'admin') {
      $_POST['role'] = 'worker';
    }
  }


  $errors = $user->validate($_POST, $id);

  if (empty($errors)) {
    // hash pwd if present
    if (empty($_POST['password'])) {
      unset($_POST['password']);
    } else {
      $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $user->update($id, $_POST);

    redirect('admin&tab=users');
  }
}

if (Auth::access('admin')) {
  require viewsPath('auth/profile');
} else {
  Auth::setMessage('You need admin rights to create users!');

  require viewsPath('auth/access');
}