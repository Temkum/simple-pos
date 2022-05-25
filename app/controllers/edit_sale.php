<?php

$errors = [];

// get id or return empty
$id = $_GET['id'] ?? null;

// read from db
$sale = new SaleModel();
$row = $sale->getSingle(['id' => $id]);

// update only if row is valid
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

    if (empty($errors)) {

        $_POST['total'] = $row['qty'] * $_POST['amount'];

        $sale->update($row['id'], $_POST);

        redirect('admin&tab=sales');
    }
}

require viewsPath('sales/edit_sale');