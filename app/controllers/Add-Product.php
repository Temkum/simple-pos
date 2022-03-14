<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $product = new ProductModel();

  $_POST['description'] = $_POST['description'];
  $_POST['user_id'] = auth('id');
  $_POST['amount'] = $_POST['amount'];
  $_POST['qty'] = $_POST['qty'];
  $_POST['barcode'] = empty($_POST['barcode']) ? $product->generateBarcode() : $_POST['barcode'];
  $_POST['date'] = date('Y-m-d H:i:s');

  if (!empty($_FILES['image']['name'])) {
    $_POST['image'] = $_FILES['image'];
  }

  $errors = $product->validate($_POST);

  if (empty($errors)) {
    $folder = 'uploads/';
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }
    $ext = strtolower(pathinfo($_POST['image']['name'], PATHINFO_EXTENSION));

    $destination = $folder . $product->generateFilename($ext);

    move_uploaded_file($_POST['image']['tmp_name'], $destination);
    $_POST['image'] = $destination;

    $product->insert($_POST);

    redirect('admin&tab=products');
  }
}

require viewsPath('products/add-product');