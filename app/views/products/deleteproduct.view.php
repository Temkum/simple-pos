 <?php
 require viewsPath('partials/header');
    ?>

 <?php if (!empty($row)):?>
 <div class="add-product container-fluid border p-4 col-lg-4 mx-auto m-top shadow">
   <h3 class="text-center">Delete Product</h3>
   <div class="alert alert-danger text-center">Are you sure you want to delete this product?!</div>

   <form action="" method="POST" enctype="multipart/form-data">
     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Product Description</label>
       <input type="text" class="form-control <?= !empty($errors['description']) ? 'border-danger' : '' ?>"
         placeholder="Enter product description" aria-label="Product Description" name="description"
         aria-describedby="basic-addon2" value="<?= setValue('description', $row['description'])?>" readonly>
     </div>

     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Barcode <small class="text-muted">
           (Optional)</small></label>
       <input type="text" class="form-control <?= !empty($errors['barcode']) ? 'border-danger' : '' ?>"
         placeholder="Barcode" aria-label="Product Barcode" aria-describedby="basic-addon2" name="barcode"
         value="<?= setValue('barcode', $row['barcode'])?>" readonly>
     </div>
     <br>
     <!-- load img -->
     <img src="<?= $row['image']?>" alt="" width="80" class="img-fluid img-thumbnail mb-2">

     <div class="btns">
       <button class="btn btn-danger w-50">Delete</button>
       <a href="index.php?page_name=admin&tab=products">
         <button type="button" class="btn btn-warning float-end">Cancel</button>
       </a>
     </div>
   </form>
   <?php else:?>
   <div class="text-center align-items-center container w-50 mt-5">
     <div class="alert alert-danger"><span><i class="bi bi-exclamation-triangle"></i></span> Product not found!</div>
     <a href="index.php?page_name=admin&tab=products">
       <button type="button" class="btn btn-primary">Back to products</button>
     </a>
   </div>
   <?php endif;?>

 </div>

 <?php require viewsPath('partials/footer');