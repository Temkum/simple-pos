<div class="table-responsive">
  <table class="table table-stripped table-hover">
    <thead>
      <tr>
        <th>Barcode</th>
        <th>Description</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
        <th>Date</th>
        <th>
          <a href="index.php?page_name=add-product">
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
        <td>
          <a href="index.php?page_name=sale_details&id=<?= $sale['id'] ?>">
            <?= esc($sale['description']) ?>
          </a>
        </td>
        <td><?= esc($sale['qty']) ?></td>
        <td><?= esc($sale['amount']) ?></td>
        <td><?= esc($sale['total']) ?></td>
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