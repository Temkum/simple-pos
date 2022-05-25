<?php

$errors = [];

// get id or return empty
$id = $_GET['id'] ?? null;

// read from db
$product = new ProductModel();
$row = $product->getSingle(['id' => $id]);

// update only if row is valid
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    $_POST['description'] = $_POST['description'];
    $_POST['amount'] = $_POST['amount'];
    $_POST['qty'] = $_POST['qty'];
    $_POST['barcode'] = empty($_POST['barcode']) ? $product->generateBarcode() : $_POST['barcode'];

    if (!empty($_FILES['image']['name'])) {
        $_POST['image'] = $_FILES['image'];
    }

    // make img upload optional on edit
    $errors = $product->validate($_POST, $row['id']);

    if (empty($errors)) {
        $folder = 'uploads/';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
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

        $product->update($row['id'], $_POST);

        redirect('admin&tab=products');
    }
}

require viewsPath('products/editproduct');