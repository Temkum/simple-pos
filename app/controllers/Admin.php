<?php

$tab = $_GET['tab'] ?? 'dashboard';

if ($tab == 'products') {
  $product_class = new ProductModel();
  $products = $product_class->query("SELECT * FROM products ORDER BY id DESC");
}

require viewsPath('admin/admin');