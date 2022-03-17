<?php

$tab = $_GET['tab'] ?? 'dashboard';

if ($tab == 'products') {
  $product_class = new ProductModel();
  $products = $product_class->query("SELECT * FROM products ORDER BY id DESC");
} else if ($tab == 'users') {
  $user_class = new UserModel();
  $users = $user_class->query("SELECT * FROM users ORDER BY id DESC");
} else if ($tab == 'sales') {
  $sale_class = new UserModel();
  $sales = $sale_class->query("SELECT * FROM sales ORDER BY id DESC");

  $year = date('Y');
  $month = date('m');
  $day = date('d');

  // get today's sales
  $sql = "SELECT sum(total) as total FROM sales WHERE day(date) = $day && month(date) = $month && year(date) = $year";

  $total_sales = $sale_class->query($sql);
  $salesTotal = 0;

  if ($total_sales) {
    $sales_total = $total_sales[0]['total'] ?? 0;
  }
}

if (Auth::access('supervisor')) {
  require viewsPath('admin/admin');
} else {
  Auth::setMessage('You do not have rights to access this page!');

  require viewsPath('auth/access');
}