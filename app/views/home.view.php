 <?php
 require viewsPath('partials/header');
    ?>
   <div class="container-fluid shadow-sm">
      <center>
         <h1><i class="bi bi-house-door"></i>
            <?= APP_NAME ?></h1>
      </center>      
   

   <div class="d-flex">
      <div class="bg-gray shadow-sm col-md-8 col-lg-6 me-3">
         <div class="input-group mb-3 w-75 p-2">
            <h4 class="me-4">Items</h4>
            <input type="text" class="form-control" placeholder="Search" aria-label="">
            <span class="input-group-text">
               <i class="bi bi-search"></i>
            </span>
         </div>

         <div class="js-products d-flex">
            <div class="card m-3" style="width: 12rem;">
               <a href="#" class=""><img src="assets/images/caramel-moolatte.png" class="card-img-top" alt="...">
               </a>
              
              <div class="card-body">
                <p class="card-title text-muted">Caramel Molatte</p>
                <p class="card-text bold"><b>$5</b></p>
              </div>
            </div>

            <div class="card m-3" style="width: 12rem;">
               <a href="#">
                  <img src="assets/images/drinks_cola_zero.jpg" class="card-img-top" alt="...">
               </a>              
              <div class="card-body">
                <p class="card-title text-muted">Coka cola</p>
                <p class="card-text bold"><b>$5</b></p>
              </div>
            </div>

            <div class="card m-3" style="width: 12rem;">
               <a href="">
                  <img src="assets/images/image.jpg" class="card-img-top" alt="...">                  
               </a>              
              <div class="card-body">
                <p class="card-title text-muted">Smoothie</p>
                <p class="card-text bold"><b>$5</b></p>
              </div>
            </div>

            <div class="card m-3" style="width: 12rem;">
               <a href="">
                  <img src="assets/images/images5.jpg" class="card-img-top" alt="...">                  
               </a>              
              <div class="card-body">
                <p class="card-title text-muted">Monster drink</p>
                <p class="card-text bold"><b>$5</b></p>
              </div>
            </div>

            <div class="card m-3" style="width: 12rem;">
               <a href="">
                  <img src="assets/images/fast-food.jpg" class="card-img-top" alt="...">                  
               </a>              
              <div class="card-body">
                <p class="card-title text-muted">Burger</p>
                <p class="card-text bold"><b>$5</b></p>
              </div>
            </div>
         </div>
      </div>

      <div class="bg-light col-md-8 col-lg-5 cart">
         <center>
            <h4>Cart <span class="badge bg-primary">5</span></h4>
         </center> 
         <table class="table table-striped table-hover">
            <thead>
               <tr>
               <th>Image</th>
               <th>Description</th>
               <th>Amount</th>
            </tr>
            </thead>            
            <tbody>
               <tr>
               <td><img src="assets/images/fast-food.jpg" class="cart-img" alt="..."> 
               </td>
               <td class="text-muted">Burger King
                  <div class="input-group my-3 numba-input">
                    <span class="input-group-text"><i class="bi bi-dash-lg"></i></span>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">
                        <i class="bi bi-plus-lg"></i>
                    </span>
                  </div>
               </td>
               <td><b>$5</b></td>
            </tr>               
            <tr>
               <td><img src="assets/images/image.jpg" class="cart-img" alt="..."> 
               </td>
               <td class="text-muted">Coffee soft drink
                  <div class="input-group my-3 numba-input">
                    <span class="input-group-text"><i class="bi bi-dash-lg"></i></span>
                    <input type="text" class="form-control" aria-label="">
                    <span class="input-group-text">
                        <i class="bi bi-plus-lg"></i>
                    </span>
                  </div>
               </td>
               <td><b>$4</b></td>
            </tr>
            </tbody>            
         </table>
      </div>
   </div>

</div>
    

<?php require viewsPath('partials/footer'); ?>  
