<?php

$tab = $_GET['tab'] ?? 'dashboard';
$section = $_GET['section'] ?? 'table';

if ($tab == 'products') {
  $product_class = new ProductModel();

  // pagination
  $limit = 8;
  $pagination = new Pagination($limit);
  $offset = $pagination->offset;

  $products = $product_class->query("SELECT * FROM products ORDER BY id DESC LIMIT $limit OFFSET $offset");
} else if ($tab == 'users') {
  $user_class = new UserModel();

  // pagination
  $limit = 8;
  $pagination = new Pagination($limit);
  $offset = $pagination->offset;

  $users = $user_class->query("SELECT * FROM users ORDER BY id DESC LIMIT $limit OFFSET $offset");
} else if ($tab == 'sales') {
  $sale_class = new SaleModel();

  // pagination
  $limit = 8;
  $pagination = new Pagination($limit);
  $offset = $pagination->offset;

  $sales = $sale_class->query("SELECT * FROM sales ORDER BY id DESC LIMIT $limit OFFSET $offset");

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