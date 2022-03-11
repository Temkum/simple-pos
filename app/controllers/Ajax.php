<?php

// prevent app attack - script exits
// defined('ABS_PATH') ? "" : die();

// create model
$products_data = new ProductModel();

// get data from db 
$rows = $products_data->getAll();

// loop through rows before echo
if ($rows) {
  foreach ($rows as $key => $row) {
    $rows[$key]['description'] = strtoupper($row['description']);
    $rows[$key]['image'] = cropImg($row['image']);
  }
  echo json_encode($rows);
}
