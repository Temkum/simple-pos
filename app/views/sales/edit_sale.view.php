 <?php
  require viewsPath('partials/header');
  ?>

 <?php if (!empty($row)) : ?>
 <div class="add-product container-fluid border p-4 col-lg-4 mx-auto m-top shadow">
   <h3 class="text-center">Edit sale</h3>

   <form action="" method="POST" enctype="multipart/form-data">
     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Sale Description</label>
       <input type="text" class="form-control <?= !empty($errors['description']) ? 'border-danger' : '' ?>"
         placeholder="Enter product description" aria-label="Sale Description" name="description"
         aria-describedby="basic-addon2" value="<?= setValue('description', $row['description']) ?>">
       <?php if (!empty($errors['description'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['description'] ?></small>
       <?php endif;  ?>
     </div>

     <div class="input-group mb-3">
       <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon1">Quantity</span>
       </div>
       <input type="number" class="form-control <?= !empty($errors['qty']) ? 'border-danger' : '' ?>"
         placeholder="Quantity" aria-label="Quantity" aria-describedby="Quantity"
         value="<?= setValue('qty', $row['qty']) ?>" name="qty">

       <div class="input-group-append">
         <span class="input-group-text" id="basic-addon1">Amount</span>
       </div>
       <input type="text" class="form-control <?= !empty($errors['amount']) ? 'border-danger' : '' ?>"
         placeholder="Amount" aria-label="Amount" aria-describedby="Price"
         value="<?= setValue('amount', $row['amount']) ?>" name="amount">

       <?php if (!empty($errors['qty'])) : ?>
       <small class="text-danger col-md-12 p-1"><?= $errors['qty'] ?></small>
       <?php endif; ?>

       <?php if (!empty($errors['amount'])) : ?>
       <small class="text-danger col-md-12 p-1 float-end"><?= $errors['amount'] ?></small>
       <?php endif; ?>
     </div>
     <br>

     <div class="btns">
       <button class="btn btn-primary">Update</button>
       <a href="index.php?page_name=admin&tab=sales">
         <button type="button" class="btn btn-warning float-end">Cancel</button>
       </a>
     </div>
   </form>
   <?php else : ?>
   <div class="text-center align-items-center container w-50 mt-5">
     <div class="alert alert-danger"><span><i class="bi bi-exclamation-triangle"></i></span> Sale record not found!
     </div>
     <a href="index.php?page_name=admin&tab=sales">
       <button type="button" class="btn btn-primary">Back to sales</button>
     </a>
   </div>
   <?php endif; ?>

 </div>

 <?php require viewsPath('partials/footer');