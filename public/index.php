<?php
session_start();

define('ABSPATH', __DIR__);

require '../app/core/init.php';

$controller = $_GET['page_name'] ?? 'home';
$controller = strtolower($controller);

if (isset($_GET['page_name'])) {
    $controller = $_GET['page_name'];
}

if (file_exists('../app/controllers/' . $controller . '.php')) {
    require '../app/controllers/' . $controller . '.php';
} else {
    echo "<center ><h2 class='mt-5'>Controller not found!</h2></center>";
}