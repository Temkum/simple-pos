 <?php
  require viewsPath('partials/header');
  ?>
 <div class="container-fluid shadow-sm">

   <div class="d-flex">
     <div class="bg-gray shadow-sm col-md-8 col-lg-6 me-3">
       <div class="input-group mb-3 w-75 p-2">
         <h4 class="me-4">Items</h4>
         <input type="text" class="form-control js-search" placeholder="Search" aria-label=""
           oninput="searchItem(event)">
         <span class="input-group-text">
           <i class="bi bi-search"></i>
         </span>
       </div>

       <div class="js-products d-flex" onclick="addItem(event)">
         <!-- load products wit ajax -->
       </div>
     </div>

     <div class="bg-light col-md-8 col-lg-5 cart">
       <center>
         <h4>Cart <span class="badge bg-primary br-20">0</span></h4>
       </center>

       <div class="table-responsive cart-table">
         <table class="table table-striped table-hover">
           <thead>
             <tr>
               <th>Image</th>
               <th>Description</th>
               <th>Amount</th>
             </tr>
           </thead>
           <tbody class="js-items">
             <!-- <tr>
               <td><img src="assets/images/fast-food.jpg" class="cart-img" alt="...">
               </td>
               <td class="text-muted">Burger King
                 <div class="input-group my-3 numba-input">
                   <span class="input-group-text"><i class="bi bi-dash-lg"></i></span>
                   <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="1">
                   <span class="input-group-text">
                     <i class="bi bi-plus-lg"></i>
                   </span>
                 </div>
               </td>
               <td><b>$5</b></td>
             </tr> -->
           </tbody>
         </table>
       </div>

       <div class="total bold p-3">
         Total: $1300
       </div>

       <!-- checkout -->
       <div class="checkout p-4">
         <button class="btn btn-success w-100 py-3 my-3">Checkout</button>
         <button class="btn btn-warning w-100">Clear items</button>
       </div>
     </div>
   </div>

 </div>

 <?php require viewsPath('partials/footer'); ?>