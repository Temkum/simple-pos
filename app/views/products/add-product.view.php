 <?php
 require viewsPath('partials/header');
    ?>

 <div class="add-product container-fluid border p-4 col-lg-4 mx-auto m-top">
   <h3 class="text-center">Add product</h3>
   <form action="" method="POST" enctype="multipart/form-data">
     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Product Description</label>
       <input type="text" class="form-control <?= !empty($errors['description']) ? 'border-danger' : '' ?>"
         placeholder="Enter product description" aria-label="Product Description" name="description"
         aria-describedby="basic-addon2">
       <?php if (!empty($errors['description'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['description'] ?></small>
       <?php endif; ?>
     </div>

     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Barcode <small class="text-muted">
           (Optional)</small></label>
       <input type="text" class="form-control <?= !empty($errors['barcode']) ? 'border-danger' : '' ?>"
         placeholder="Barcode" aria-label="Product Barcode" aria-describedby="basic-addon2" name="barcode">
       <?php if (!empty($errors['barcode'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['barcode'] ?></small>
       <?php endif; ?>
     </div>

     <div class="input-group mb-3">
       <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon1">Quantity</span>
       </div>
       <input type="number" class="form-control <?= !empty($errors['qty']) ? 'border-danger' : '' ?>"
         placeholder="Quantity" aria-label="Quantity" aria-describedby="Quantity" value="1" name="qty">

       <div class="input-group-append">
         <span class="input-group-text" id="basic-addon1">Amount</span>
       </div>
       <input type="number" class="form-control <?= !empty($errors['amount']) ? 'border-danger' : '' ?>"
         placeholder="Amount" aria-label="Amount" aria-describedby="Price" value="0" name="amount">

       <?php if (!empty($errors['qty'])) : ?>
       <small class="text-danger col-md-12 p-1"><?= $errors['qty'] ?></small>
       <?php endif; ?>

       <?php if (!empty($errors['amount'])) : ?>
       <small class="text-danger col-md-12 p-1 float-end"><?= $errors['amount'] ?></small>
       <?php endif; ?>
     </div>

     <div class="mb-3">
       <input type="file" class="form-control <?= !empty($errors['image']) ? 'border-danger' : '' ?>"
         aria-label="Product Image" aria-describedby="basic-addon2" name="image">
       <?php if (!empty($errors['image'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['image'] ?></small>
       <?php endif; ?>
     </div>

     <div class="btns">
       <button class="btn btn-primary">Save</button>
       <a href="index.php?page_name=admin&tab=products">
         <button type="button" class="btn btn-warning float-end">Cancel</button>
       </a>
     </div>
   </form>

 </div>

 <?php require viewsPath('partials/footer');