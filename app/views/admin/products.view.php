<div class="table-responsive">
  <table class="table table-stripped table-hover">
    <thead>
      <tr>
        <th>Barcode</th>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Image</th>
        <th>Date</th>
        <th>
          <a href="index.php?page_name=add-product">
            <button class="btn btn-success btn-sm"><i class="bi bi-plus-lg"></i> Add new</button>
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($products)):?>
      <?php foreach ($products as $product) : ?>
      <tr>
        <td><?= esc($product->barcode)?></td>
        <td><?= esc($product->description)?></td>
        <td><?= esc($product->qty)?></td>
        <td><?= esc($product->amount)?></td>
        <td>Image</td>
        <td><?= esc($product->date)?></td>
        <td>
          <div class="btn-group">
            <button class="btn btn-success btn-sm">Edit</button>
            <button class="btn btn-danger btn-sm">Delete</button>
          </div>
        </td>
      </tr>
      <?php endforeach;?>

      <?php endif;?>
    </tbody>
  </table>

</div>