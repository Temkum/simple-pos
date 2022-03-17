<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Table view</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Graph view</a>
  </li>
</ul>
<br>

<div class="table-responsive">
  <!-- sales total -->
  <h3 class="alert">Today's total: $<?= number_format($sales_total, 2) ?></h3>
  <table class="table table-stripped table-hover">
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
        <td><?= esc($sale['barcode']) ?></td>
        <td><?= esc($sale['description']) ?></td>
        <td><?= esc($sale['qty']) ?></td>
        <td><?= esc($sale['amount']) ?></td>
        <td><?= esc($sale['total']) ?></td>
        <td><?= esc($sale['user_id']) ?></td>
        <td><?= date("jS M, Y", strtotime($sale['date'])) ?></td>
        <td>
          <div class="btn-group">
            <a href="index.php?page_name=editsale&id=<?= $sale['id'] ?>">
              <button class="btn btn-success btn-sm">Edit</button>
            </a>
            <a href="index.php?page_name=deletesale&id=<?= $sale['id'] ?>">
              <button class="btn btn-danger btn-sm">Delete</button>
            </a>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>

      <?php endif; ?>
    </tbody>
  </table>

</div>