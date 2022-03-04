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

function redirect($page)
{
    header("Location: index.php?page_name=" . $page);
}

function setValue($key, $default = '')
{
    if (!empty($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}

function authenticate($row)
{
    $_SESSION['user'] = $row[0];
}

function auth($column)
{
    if (!empty($_SESSION['user'][$column])) {
        return $_SESSION['user'][$column];
    }
    return 'Guest';
}
