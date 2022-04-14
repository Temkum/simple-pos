<?php

$errors = [];
$user = new UserModel();

$id = $_GET['id'] ?? null;
$row = $user->getSingle(['id' => $id]);

if (!empty($_SERVER['HTTP_REFERER'])) {
  $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // ensure only admins can create admins
  if (isset($_POST['role']) && $_POST['role'] != $row['role']) {

    if (Auth::getUserData('role') != 'admin') {
      $_POST['role'] = $row['role'];
    }
  }

  // load img if it exists
  if (!empty($_FILES['image']['name'])) {
    $_POST['image'] = $_FILES['image'];
  }

  $errors = $user->validate($_POST, $id);

  if (empty($errors)) {

    $folder = 'uploads/';
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }
    $product = new ProductModel();

    if (!empty($_POST['image'])) {
      # code...
      $ext = strtolower(pathinfo($_POST['image']['name'], PATHINFO_EXTENSION));

      $destination = $folder . $product->generateFilename($ext);

      move_uploaded_file($_POST['image']['tmp_name'], $destination);
      $_POST['image'] = $destination;

      // delete old img if new one is uploaded
      if (file_exists($row['image'])) {
        unlink($row['image']);
      }
    }

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