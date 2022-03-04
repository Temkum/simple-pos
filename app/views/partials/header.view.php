<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc(APP_NAME) ?></title>

  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-icons.css">

  <!-- custom css -->
  <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body class="bg bg-gray">
  <?php
     $no_nav[] = 'login';
     $no_nav[] = 'signup';
     
     if (!in_array($controller, $no_nav)) {
         require viewsPath('partials/nav');
     }
        ?>

  <!-- main container -->
  <div class="container-fluid w-35">