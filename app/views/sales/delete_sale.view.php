 <?php
  require viewsPath('partials/header');
  ?>

 <style>
input[value] {
  font-weight: bold;
}
 </style>

 <?php if (!empty($row)) : ?>
 <div class="add-product container-fluid border p-4 col-lg-4 mx-auto m-top shadow">
   <h3 class="text-center">Delete Sale</h3>
   <div class="alert alert-danger text-center">Sure you want to delete this record?!</div>

   <form action="" method="POST" enctype="multipart/form-data">
     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Sale Description</label>
       <input type="text" class="form-control <?= !empty($errors['description']) ? 'border-danger' : '' ?>"
         aria-label="Sale Description" name="description" aria-describedby="basic-addon2"
         value="<?= setValue('description', $row['description']) ?>" readonly>
     </div>

     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Barcode</label>
       <input type="text" class="form-control <?= !empty($errors['barcode']) ? 'border-danger' : '' ?>"
         placeholder="Barcode" aria-label="Sale Barcode" aria-describedby="basic-addon2" name="barcode"
         value="<?= setValue('barcode', $row['barcode']) ?>" readonly>
     </div>

     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Total</label>
       <input type="text" class="form-control <?= !empty($errors['total']) ? 'border-danger' : '' ?>"
         placeholder="Total" aria-label="Sale Total" aria-describedby="basic-addon2" name="total"
         value="<?= setValue('total', $row['total']) ?>" readonly>
     </div>
     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Date</label>
       <input type="text" class="form-control <?= !empty($errors['date']) ? 'border-danger' : '' ?>" placeholder="Date"
         aria-label="Sale Date" aria-describedby="basic-addon2" name="date"
         value="<?= setValue('date', $row['date']) ?>" readonly>
     </div>
     <br>

     <div class="btns">
       <button class="btn btn-danger w-50">Delete</button>
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