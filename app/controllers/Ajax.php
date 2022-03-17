<?php

// prevent app attack - script exits
// defined('ABS_PATH') ? "" : die();

// capture ajax data
$raw_data = file_get_contents("php://input");
if (!empty($raw_data)) {
  #convert data to array
  $data_obj = json_decode($raw_data, true);

  if (is_array($data_obj)) {
    if ($data_obj['dataType'] == 'search') {

      // create model instance
      $products_data = new ProductModel();
      $limit = 20;

      if (!empty($data_obj['text'])) {
        # perform search
        $text = "%" . $data_obj['text'] . "%";
        $barcode_search = $data_obj['text'];
        $query = "SELECT * FROM products WHERE description LIKE :find || barcode = :barcode_search ORDER BY views DESC LIMIT $limit";
        $rows = $products_data->query($query, ['find' => $text, 'barcode_search' => $barcode_search]);
      } else {
        // get data from db 
        $rows = $products_data->getAll($limit, 0, 'DESC', 'views');
      }

      // loop through rows before echo
      if ($rows) {
        foreach ($rows as $key => $row) {
          $rows[$key]['description'] = strtoupper($row['description']);
          $rows[$key]['image'] = cropImg($row['image']);
        }

        // if data doesn't exist
        $info['dataType'] = 'search';
        $info['data'] = $rows;

        echo json_encode($info);
      }
    } else {
      if ($data_obj['dataType'] == 'checkout') {
        // get 1 item at a time and save to db
        $checkout_OBJ = $data_obj['text'];
        $receipt_no = getReceiptNum();
        $user_id = auth('id');
        $date = date('Y-m-d H:i:s');

        $db = new Database();

        // read from db
        foreach ($checkout_OBJ as $row) {
          $arr = [];
          $arr['id'] = $row['id'];
          $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";
          $check_sql = $db->query($sql, $arr);

          if (is_array($arr)) {
            // get the first item
            $check_sql = $check_sql[0];

            # save to db
            $arr = [];
            $arr['barcode'] = $check_sql['barcode'];
            $arr['receipt_num'] = $receipt_no;
            $arr['description'] = $check_sql['description'];
            $arr['qty'] = $row['qty'];
            $arr['amount'] = $check_sql['amount'];
            $arr['total'] = $row['qty'] * $check_sql['amount'];
            $arr['user_id'] = $user_id;
            $arr['date'] = $date;

            $sql = "INSERT INTO sales (barcode, receipt_num, description, qty, amount, total, user_id, date) VALUES(:barcode, :receipt_num, :description, :qty, :amount, :total, :user_id, :date)";
            $db->query($sql, $arr);

            // add view count
            $sql = "UPDATE products SET views = views + 1 WHERE id = :id LIMIT 1";
            $db->query($sql, ['id' => $check_sql['id']]);
          }
        }

        $info['dataType'] = 'checkout';
        $info['dataType'] = 'Item saved successfully!';

        echo json_encode($info);
      }
    }
  }
}