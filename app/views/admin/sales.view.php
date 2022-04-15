<style>
.w-10 {
  width: 40%;
}

#limit {
  width: 80px;
}

svg {
  width: 100%;
  height: 400px;
}

svg polyline {
  stroke-width: 2;
  stroke: #ddd;
  fill: #ddd;
}

svg circle {
  stroke-width: 4;
  stroke: #ccc;
  fill: white;
}

svg circle:hover {
  stroke: pink;
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
  ?>

<svg class="border" viewBox="0 0 <?= $canvasX ?> <?= $canvasY ?>">
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
      $x2 = $canvasX;

      $y1 = $i * $max_lines;
      $y2 = $y1;
    ?>
  <polyline points="<?= $x1 ?>,<?= $y1 ?> <?= $x2 ?>,<?= $y2 ?>" />

  <?php
    }
    ?>
  <polyline points="<?= $points ?>" />
  <!-- <circle r="4" cx="100" cy="100" />
  <circle r="4" cx="200" cy="150" /> -->
</svg>
<?php endif; ?>