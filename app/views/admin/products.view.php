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
        <td><?= esc($product['barcode'])?></td>
        <td>
          <a href="index.php?page_name=product_details&id=<?= $product['id'] ?>">
            <?= esc($product['description'])?>
          </a>
        </td>
        <td><?= esc($product['qty'])?></td>
        <td><?= esc($product['amount'])?></td>
        <td><img src="<?= $product['image'] ?>" alt="" width="100"></td>
        <td><?= esc($product['date'])?></td>
        <td>
          <div class="btn-group">
            <a href="index.php?page_name=editproduct&id=<?= $product['id'] ?>">
              <button class="btn btn-success btn-sm">Edit</button>
            </a>
            <a href="index.php?page_name=deleteproduct&id=<?= $product['id'] ?>">
              <button class="btn btn-danger btn-sm">Delete</button>
            </a>
          </div>
        </td>
      </tr>
      <?php endforeach;?>

      <?php endif;?>
    </tbody>
  </table>

</div>