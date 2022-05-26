<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // set enter key
    $WshShell = new COM('WScript.Shell');
    $obj = $WshShell->Run("cmd /c WScript.exe " . ABSPATH . " /file.vbs", 0, true);
    // $obj = $WshShell->Run("cmd /c WScript.exe " www/public/file.vbs", 0, true);

    $WshShell = new COM('WScript.Shell');
    $obj = $WshShell->Run("cmd /c WScript.exe " . ABSPATH . " /file.vbs", 0, true);
    // $obj = $WshShell->Run("cmd /c WScript.exe www/public/file.vbs", 0, true);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=esc(APP_NAME)?></title>

  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-icons.css">

  <!-- custom css -->
  <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
  <?php
$vars = $_GET['vars'] ?? "";

$obj = json_decode($_GET['vars'], true);
?>

  <!-- check if obj has data -->
  <?php if (is_array($obj)): ?>
  <center>
    <h4><?=$obj['company']?></h4>
    <h4>Receipt</h4>
    <h6><i><?=date("jS F, Y H:i a")?></i></h6>
  </center>

  <table class="table table-striped table-responsive">
    <tr>
      <th> Qty </th>
      <th> Description </th>
      <th> @ </th>
      <th> Amount </th>
    </tr>
    <?php foreach ($obj['data'] as $row): ?>
    <tr>
      <th> <?=$row['qty']?></th>
      <th><?=$row['description']?></th>
      <th>$<?=$row['amount']?></th>
      <th> $ <?=number_format($row['qty'] * $row['amount'], 2)?></th>
    </tr>
    <?php endforeach?>

    <tr>
      <td colspan="2"></td>
      <td><b>Total:</b></td>
      <td colspan="2"><b><?=$obj['grand_total']?></b></td>
    </tr>
    <tr>
      <td colspan="2"></td>
      <td>Amount paid:</td>
      <td colspan="2"><?=$obj['amount']?></td>
    </tr>
    <tr>
      <td colspan="2"></td>
      <td>Change:</td>
      <td colspan="2"><?=$obj['change']?></td>
    </tr>
  </table>
  <center>
    <p>
      <i>Thanks for shopping with us!</i>
    </p>
  </center>
  <?php endif?>

  <script src="assets/js/all.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/app.js"></script>

  <script>
  window.print();

  // create ajax request to request print page
  let ajax = new XMLHttpRequest();

  // handle errors
  ajax.addEventListener('readystatechange', function() {
    if (ajax.readyState == 4) {
      //   console.log(ajax.responseText)
    }
  })

  ajax.open('POST', '', true); //add true to make it async
  ajax.send();
  </script>
</body>

</html>