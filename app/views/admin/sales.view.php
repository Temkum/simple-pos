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
  fill: #666;
}

svg circle {
  stroke-width: 4;
  stroke: #ddd;
  /* fill: #eee; */
}

svg circle:hover {
  stroke: pink;
}

svg text {
  fill: rebeccapurple;
  font-size: 12px;
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
  $graph = new Graph();
  $data = [];

  // test data
  for ($i = 0; $i < 31; $i++) {
    $data[$i] = rand(0, 500);
  }

  $graph->display($data);

  $data = [];

  // test data week
  for ($i = 0; $i < 7; $i++) {
    $data[$i] = rand(0, 500);
  }
  $graph->display($data);

  // test data day
  for ($i = 0; $i < 12; $i++) {
    $data[$i] = rand(0, 500);
  }
  $graph->display($data);
  ?>
<?php endif; ?>