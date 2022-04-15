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
  // date range
  $start_date = $_GET['start'] ?? null;
  $end_date = $_GET['end'] ?? null;

  $sale_class = new SaleModel();

  // pagination
  $limit = $_GET['limit'] ?? 20;
  $limit = (int)$limit; //cast as an int
  $limit = $limit < 1 ? 10 : $limit;
  $pagination = new Pagination($limit);
  $offset = $pagination->offset;

  $sales_query = "SELECT * FROM sales ORDER BY id DESC LIMIT $limit OFFSET $offset";

  $year = date('Y');
  $month = date('m');
  $day = date('d');

  // get today's sales
  $sql_total = "SELECT sum(total) as total FROM sales WHERE day(date) = $day && month(date) = $month && year(date) = $year";

  //date range if both start and end date are set
  if ($start_date && $end_date) {
    $start_year = date('Y', strtotime($start_date));
    $start_month = date('m', strtotime($start_date));
    $start_day = date('d', strtotime($start_date));

    $end_yr = date('Y', strtotime($end_date));
    $end_month = date('m', strtotime($end_date));
    $end_day = date('d', strtotime($end_date));

    $range_query = "SELECT * FROM sales WHERE (YEAR(date) >= '$start_year' && MONTH(date) >= '$start_month' && DAY(date) >= '$start_day') && (YEAR(date) <= '$start_year' && MONTH(date) <= '$start_month' && DAY(date) <= '$start_day') ORDER BY id ASC LIMIT $limit OFFSET $offset";

    $sql_total = "SELECT sum(total) as total FROM sales WHERE (YEAR(date) >= '$start_year' && MONTH(date) >= '$start_month' && DAY(date) >= '$start_day')";
  } else {

    //if only start is set
    if ($start_date && !$end_date) {
      $start_year = date('Y', strtotime($start_date));
      $start_month = date('m', strtotime($start_date));
      $start_day = date('d', strtotime($start_date));

      $range_query = "SELECT * FROM sales WHERE (YEAR(date) = '$start_year' && MONTH(date) = '$start_month' && DAY(date) = '$start_day') ORDER BY id ASC LIMIT $limit OFFSET $offset";

      $sql_total = "SELECT sum(total) as total FROM sales WHERE (YEAR(date) = '$start_year' && MONTH(date) = '$start_month' && DAY(date) = '$start_day')";
    }
  }

  $sales = $sale_class->query($sales_query);

  $total_sales = $sale_class->query($sql_total);
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