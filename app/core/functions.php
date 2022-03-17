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
    exit;
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

function cropImg($filename, $size = 400, $type = 'product')
{
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $cropped_file = preg_replace("/\.$ext$/", "_cropped." . $ext, $filename);

    // prevent file from cropping twice
    if (file_exists($cropped_file)) {
        return $cropped_file;
    }

    // if file to be cropped doesn't exist
    if (!file_exists($filename)) {
        if ($type == 'male') {
            return 'assets/images/male-avatar.jpg';
        } else if ($type == 'female') {
            return 'assets/images/girl-avatar.png';
        } else {
            return 'assets/images/u2.jpg';
        }
    }

    // create img resource using file extension
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $src_image = imagecreatefromjpeg($filename);
            break;
        case 'gif':
            $src_image = imagecreatefromgif($filename);
            break;
        case 'png':
            $src_image = imagecreatefrompng($filename);
            break;
        default:
            return $filename;
            break;
    }

    // assign 0 to const variables
    $dst_x = 0;
    $dst_y = 0;
    $dst_width = (int)$size;
    $dst_height = (int)$size;

    $original_width = imagesx($src_image);
    $original_height = imagesy($src_image);

    if ($original_width < $original_height) {
        $src_x = 0;
        $src_y = ($original_height - $original_width) / 2;
        $src_width = $original_width;
        $src_height = $original_width;
    } else {
        $src_y = 0;
        $src_x = ($original_width - $original_height) / 2;
        $src_width = $original_height;
        $src_height = $original_height;
    }

    // set cropping params
    $dst_image = imagecreatetruecolor((int)$size, (int)$size);

    imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);

    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($dst_image, $cropped_file, 90);
            break;
        case 'gif':
            imagegif($dst_image, $cropped_file);
            break;
        case 'png':
            imagepng($dst_image, $cropped_file);
            break;
        default:
            return $filename;
            break;
    }

    imagedestroy($dst_image);
    imagedestroy($src_image);

    return $cropped_file;
}

function getReceiptNum()
{
    $num = 1;

    $db = new Database;
    $rows = $db->query("SELECT receipt_num FROM sales ORDER BY id DESC LIMIT 1");

    if (is_array($rows)) {
        # code...
        $num = (int)$rows[0]['receipt_num'] + 1;
    }

    return $num;
}