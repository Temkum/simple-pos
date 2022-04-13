<?php

$errors = [];
$user = new UserModel();

$id = $_GET['id'] ?? null;

$row = $user->getSingle(['id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // ensure only admins can create admins
  if (isset($_POST['role']) && $_POST['role'] != $row['role']) {

    if (Auth::getUserData('role') != 'admin') {
      $_POST['role'] = $row['role'];
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

    redirect("edit_user&id=$id");
  }
}

if (Auth::access('admin') || ($row && $row['id'] == Auth::getUserData('id'))) {
  require viewsPath('auth/edit_user');
} else {
  Auth::setMessage('You need admin rights to create users!');

  require viewsPath('auth/access');
}