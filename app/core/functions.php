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
