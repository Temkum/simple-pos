<?php

function show($data)
{
    echo '<pre>';
    print_r($data);
    echo "</pre>";
}

function viewsPath($view)
{
    // check if file path is valid
    if (file_exists("../app/views/$view.view.php")) {
        return "../app/views/$view.view.php";
    } else {
        echo "$view not found!";
    }
}

function esc($str)
{
    return htmlspecialchars($str);
}

connect();
function connect()
{
    $DB_HOST = 'localhost';
    $DB_NAME = 'pos_desktop';
    $DB_USER = 'root';
    $DB_PWD= 'loveisall21';
    $DB_DRIVER = 'mysql';

    try {
        // we use php data objects to connect PDO
        $db_string = "$DB_DRIVER:host=$DB_HOST;dbname=$DB_NAME";

        $link = new PDO($db_string, $DB_USER, $DB_PWD); //create an instance
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    return $link;
}
