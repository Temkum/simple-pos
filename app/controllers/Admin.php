<?php

$tab = $_GET['tab'] ?? 'dashboard';

if ($tab == 'products') {
  $product_class = new ProductModel();
  $products = $product_class->query("SELECT * FROM products ORDER BY id DESC");
}

if (Auth::access('supervisor')) {
  require viewsPath('admin/admin');
} else {
  Auth::setMessage('You do not have rights to access this page!');

  require viewsPath('auth/access');
}