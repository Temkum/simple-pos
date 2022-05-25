<?php

$errors = [];

// get id or return empty
$id = $_GET['id'] ?? null;

// read from db
$sale = new SaleModel();
$row = $sale->getSingle(['id' => $id]);

// update only if row is valid
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
    $sale->delete($row['id']);

    // delete old img if new one is uploaded
    if (file_exists($row['image'])) {
        unlink($row['image']);
    }
    redirect('admin&tab=sales');
}

require viewsPath('sales/delete_sale');