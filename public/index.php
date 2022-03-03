<?php
session_start();

require '../app/core/init.php';

$controller = $_GET['page_name'] ?? 'home';
$controller = strtolower($controller);

if (file_exists('../app/controllers/'. $controller . '.php')) {
    require '../app/controllers/'. $controller . '.php';
} else {
    echo "Controller not found!";
}
