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
} else if ($tab == 'dashboard') {
  $db = new Database;

  $sql = "SELECT count(id) as total FROM users";
  $my_users = $db->query($sql);
  $total_users = $my_users[0]['total'];

  $sql = "SELECT count(id) as total FROM products";
  $my_prods = $db->query($sql);
  $total_products = $my_users[0]['total'];

  $sql = "SELECT sum(total) as total FROM sales";
  $my_sales = $db->query($sql);
  $total_sales = $my_sales[0]['total'];
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
    $range_query = "SELECT * FROM sales WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY id DESC LIMIT $limit OFFSET $offset";

    $sql_total = "SELECT sum(total) as total FROM sales WHERE date BETWEEN '$start_date' AND '$end_date' ";
  } else {

    //if only start is set
    if ($start_date && !$end_date) {
      $range_query = "SELECT * FROM sales WHERE date = '$start_date' ORDER BY id ASC LIMIT $limit OFFSET $offset";

      $sql_total = "SELECT sum(total) as total FROM sales WHERE date = $start_date ";
    }
  }

  $sales = $sale_class->query($sales_query);

  $total_sales = $sale_class->query($sql_total);
  $sales_total = 0;

  if ($total_sales) {
    $sales_total = $total_sales[0]['total'] ?? 0;
  }

  // graph data
  if ($section == 'graph') {
    # read graph data
    $db = new Database();

    // query today's records
    $today = date('Y-m-d');
    $query = "SELECT total, date FROM sales WHERE DATE(date)='$today' ";
    $today_records = $db->query($query);

    // query month's records
    $this_month = date('m');
    $this_year = date('Y');
    $query = "SELECT total, date FROM sales WHERE month(date) = '$this_month' AND year(date)='$this_year' ";
    $this_month_records = $db->query($query);

    // query year's records
    $query = "SELECT total, date FROM sales WHERE year(date)='$this_year' ";
    $this_year_records = $db->query($query);
  }
}

if (Auth::access('supervisor')) {
  require viewsPath('admin/admin');
} else {
  Auth::setMessage('You do not have rights to access this page!');

  require viewsPath('auth/access');
}
