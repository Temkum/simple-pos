 <?php
 require viewsPath('partials/header');
    ?>

 <div class="add-product container-fluid border p-4 m-2 col-lg-4 mx-auto">
   <h3>Add product</h3>
   <form action="" method="POST" enctype="">
     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Product Description</label>
       <input type="text" class="form-control" placeholder="Enter product description" aria-label="Product Description"
         name="description" aria-describedby="basic-addon2">
     </div>
     <div class="input-group mb-3 mt-3">
       <label class="input-group-text" for="inputGroupSelect01">Barcode <small class="text-muted">
           (Optional)</small></label>
       <input type="text" class="form-control" placeholder="Barcode" aria-label="Product Barcode"
         aria-describedby="basic-addon2" name="barcode">
     </div>

     <div class="input-group mb-3">
       <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon1">Quantity</span>
       </div>
       <input type="number" class="form-control" placeholder="Quantity" aria-label="Quantity"
         aria-describedby="Quantity" value="1" name="qty" required>
       <div class="input-group-append">
         <span class="input-group-text" id="basic-addon1">Amount</span>
       </div>
       <input type="number" class="form-control" placeholder="Amount" aria-label="Amount" aria-describedby="Price"
         value="0.00" step="0.05" name="amount" required>
     </div>

     <div class="mb-3">
       <input type="file" class="form-control" placeholder="Barcode" aria-label="Product Barcode"
         aria-describedby="basic-addon2" name="image">
     </div>

     <div class="btns">
       <button class="btn btn-primary">Save</button>
       <button type="button" class="btn btn-warning float-end">Cancel</button>
     </div>
   </form>

 </div>

 <?php require viewsPath('partials/footer');