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

      if (!empty($data_obj['text'])) {
        # perform search
        $text = "%" . $data_obj['text'] . "%";
        $query = "SELECT * FROM products WHERE description LIKE :find || barcode = :find LIMIT 10";
        $rows = $products_data->query($query, ['find' => $text]);
      } else {
        // get data from db 
        $rows = $products_data->getAll();
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
    }
  }
}