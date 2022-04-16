<style>
.w-10 {
  width: 40%;
}

#limit {
  width: 80px;
}

svg {
  width: 80%;
  height: 500px;
}

svg polyline {
  stroke-width: 2;
  stroke: #ddd;
  fill: #ddd;
}

svg circle {
  stroke-width: 4;
  stroke: #ddd;
  fill: white;
}

svg circle:hover {
  stroke: pink;
}

svg text {
  fill: rebeccapurple;
  font-size: 15px;
}
</style>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?= ($section == 'table') ? 'active' : '' ?>" aria-current="page"
      href="index.php?page_name=admin&tab=sales&section=table">Table view</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= ($section == 'graph') ? 'active' : '' ?>"
      href="index.php?page_name=admin&tab=sales&section=graph">Graph
      view</a>
  </li>
</ul>
<br>

<?php if ($section == 'table') : ?>
<div>
  <form class="row float-end justify-content-center">
    <div class="col">
      <label for="start">Start Date</label>
      <input id="start" type="date" name="start" class="form-control"
        value="<?= !empty($_GET['start']) ? $_GET['start'] : '' ?>">
    </div>
    <div class="col">
      <label for="end">End Date</label>
      <input id="end" type="date" name="end" class="form-control"
        value="<?= !empty($_GET['end']) ? $_GET['end'] : '' ?>">
    </div>
    <div class="col">
      <label for="end">Rows</label>
      <input id="limit" type="number" min="1" name="limit" class="form-control"
        value="<?= !empty($_GET['limit']) ? $_GET['limit'] : '' ?>">
    </div>
    <button class="btn btn-primary mt-2 btn-sm w-10 text-center">Go</button>

    <input type="hidden" name="page_name" value="admin">
    <input type="hidden" name="tab" value="sales">
  </form>
  <div class="clearfix"></div>
</div>
<div class="table-responsive">
  <!-- sales total -->
  <h4>Today's total: <span class="text-success">$<?= number_format($sales_total, 2) ?></span></h4>
  <table class=" table table-stripped table-hover">
    <thead>
      <tr>
        <th>Receipt Number</th>
        <th>Description</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
        <th>Cashier</th>
        <th>Date</th>
        <th>
          <a href="index.php?page_name=home">
            <button class="btn btn-success btn-sm"><i class="bi bi-plus-lg"></i> Add new</button>
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($sales)) : ?>
      <?php foreach ($sales as $sale) : ?>
      <tr>
        <td><?= esc($sale["barcode"]) ?></td>
        <td><?= esc($sale["description"]) ?></td>
        <td><?= esc($sale["qty"]) ?></td>
        <td><?= esc($sale["amount"]) ?></td>
        <td><?= esc($sale["total"]) ?></td>

        <?php
              $cashier = getUserById($sale["user_id"]);

              if (empty($cashier)) {
                $name = 'Unknown';
                $name_link = '#';
              } else {
                $name = $cashier['username'];
                $name_link = "index.php?page_name=profile&id=" . $cashier['id'];
              }
              ?>

        <td>
          <a href="<?= $name_link ?>">
            <?= esc($name) ?>
          </a>
        </td>
        <td><?= date("jS M, Y", strtotime($sale["date"])) ?></td>
        <td>
          <div class="btn-group">
            <a href="index.php?page_name=edit_sale&id=<?= $sale['id'] ?>">
              <button class="btn btn-success btn-sm">Edit</button>
            </a>
            <a href="index.php?page_name=delete_sale&id=<?= $sale['id'] ?>">
              <button class="btn btn-danger btn-sm">Delete</button>
            </a>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <?php $pagination->display(); ?>
</div>
<?php else : ?>
<h2>Graph</h2>

<!-- graph data -->
<?php
  $canvasX = 1000;
  $canvasY = 400;

  $data = [];
  $data['Jan'] = 50;
  $data['Feb'] = 10;
  $data['Mar'] = 30;
  $data['Apr'] = 60;
  $data['May'] = 70;
  $data['Jun'] = 40;
  $data['Jul'] = 90;
  $data['Aug'] = 100;
  $data['Sep'] = 20;
  $data['Oct'] = 80;
  $data['Nov'] = 50;
  $data['Dec'] = 60;

  $xText = array_keys($data);

  $max_Y = max($data);
  $max_X = count($data);

  $multiplier_Y = $canvasY / $max_Y;
  $multiplier_X = $canvasX / $max_X;

  // create a num to use since key is not a number
  $num = 1;
  $points = "0, $canvasY ";

  foreach ($data as $key => $value) {
    $points .= $multiplier_X * $num . "," . $canvasY - ($value * $multiplier_Y) . " ";
    $num++;
  }
  $points .= "$canvasX, $canvasY";

  $extraX = 100;
  $extraY = ($max_Y / $multiplier_Y);
  ?>

<svg class="border" viewBox="0 -<?= $extraY ?> <?= $canvasX + $extraX * 2 ?> <?= $canvasY + $extraY ?>">

  <!-- top to bottom lines -->
  <?php
    for ($i = 0; $i < $max_X; $i++) {
      $x1 = $i * $multiplier_X;
      $y1 = 0;

      $x2 = $x1;
      $y2 = $canvasY;
    ?>
  <polyline points="<?= $x1 ?>,<?= $y1 ?> <?= $x2 ?>,<?= $y2 ?>" />

  <?php
    }
    ?>
  <polyline points="<?= $points ?>" />

  <!-- left to right lines -->
  <?php
    $max_lines = $max_Y / $multiplier_Y;
    for ($i = 0; $i < $max_lines; $i++) {
      $x1 = 0;
      $y1 = $i * $max_lines;
      $x2 = $canvasX;
      $y2 = $y1;

      if ($y1 > $canvasY) {
        $total_Ylines = $i - 1;
        break;
      }
    ?>
  <polyline points="<?= $x1 ?>,<?= $y1 ?> <?= $x2 ?>,<?= $y2 ?>" />
  <?php
    }
    ?>

  <polyline points="<?= $points ?>" />

  <?php
    $num = 1;
    $points = "0,$canvasY ";
    foreach ($data as $key => $value) {
    ?>
  <circle r="8" cx="<?= $multiplier_X * $num ?>" cy="<?= $canvasY - ($value * $multiplier_Y) ?>" />
  <?php
      $num++;
    }
    ?>

  <!-- x text values-->
  <?php $num = 0; ?>
  <?php
    foreach ($xText as $value) : $num++ ?>
  <text x="<?= $num * $multiplier_X ?>" y="<?= $canvasY ?>"><?= $value ?></text>
  <?php endforeach; ?>

  <!-- y values -->
  <?php
    $max_lines = $max_Y / $multiplier_Y;
    $num = $max_Y;
    for ($i = 0; $i < $max_lines; $i++) {
      $x = $canvasX;
      $y = $i * $max_lines;
      if (round($num) < 0) {
        break;
      }
    ?>
  <text x="<?= $x - ($multiplier_X / 20) ?>" y="<?= $y ?>"><?= round($num) ?></text>
  <?php
      $num -= $max_Y / $total_Ylines;
    }
    ?>

</svg>
<?php endif; ?>