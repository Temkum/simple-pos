<?php

require '../app/core/config.php';
require '../app/core/functions.php';
require '../app/core/database.php';
require '../app/core/model.php';

// include a file only when needed
spl_autoload_register('myModel');

function myModel($classname)
{
    $filename = '../app/models/' . ucfirst($classname) . ".php";
    // check if class exist
    if (file_exists($filename)) {
         require $filename;
    }
}
