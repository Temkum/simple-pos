<?php

$errors = [];

// get id or return empty
$id = $_GET['id'] ?? null;

// read from db
$product = new ProductModel();
$row = $product->getSingle(['id' => $id]);

// update only if row is valid
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
    $product->delete($row['id']);

    // delete old img if new one is uploaded
    if (file_exists($row['image'])) {
        unlink($row['image']);
    }
    redirect('admin&tab=products');
}

require viewsPath('products/delete_product');