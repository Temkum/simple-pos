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

function query($query, $data = [])
{
    $conn = connect();

    // prepare a stmt
    $stmt = $conn->prepare($query);
    $check = $stmt->execute($data);

    if ($check) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (is_array($result) && count($result) > 0) {
            return $result;
        }
    }
    return false;
}

function allowedColumns($data, $table)
{
    if ($table == 'users') {
        $columns =[
            'name',
            'username',
            'email',
            'role',
            'password',
            'image',
            'date',
        ];

        foreach ($data as $key => $value) {
            // check if key is in columns arr
            if (!in_array($key, $columns)) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}

function insert($data, $table)
{
    $clean_arr = allowedColumns($data, $table);

    $keys = array_keys($clean_arr);

    $sql= "INSERT INTO $table ";
    $sql .= "(". implode(',', $keys) .") VALUES (:";
    $sql .= implode(',:', $keys) .")";
    
    query($sql, $clean_arr);
}

function validate($data, $table)
{
    $errors = [];

    if ($table == 'users') {
        if (empty($data['name'])) {
            $errors['name'] = 'Name field cannot be empty!';
        } elseif (!preg_match('/[a-zA-Z ]/', $data['name'])) {
            $errors['name'] = 'Only letters are allowed in name field!';
        }

        if (empty($data['username'])) {
            $errors['username'] = 'Username is required!';
        } elseif (!preg_match('/[a-zA-Z0-9_]/', $data['username'])) {
            $errors['username'] = 'Spaces are not allowed in username!';
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is not valid!';
        } elseif (empty($data['email'])) {
            $errors['email'] = 'Email is required!';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Password is required!';
        } elseif ($data['password'] !== $data['repeat_pwd']) {
            $errors['repeat_pwd'] = 'Passwords do not match!';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'Password must be at least 6 characters!';
        }
    }

    return $errors;
}

function setValue($key, $default = '')
{
    if (!empty($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}

function auth($row)
{
    $_SESSION['user'] = $row;
}
