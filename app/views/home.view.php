 <?php
 require viewsPath('partials/header');
    ?>
   <div class="container-fluid shadow-sm">
      <center>
         <h1><i class="bi bi-house-door"></i>
            <?= APP_NAME ?></h1>
      </center>      
   

   <div class="d-flex ">
      <div class="shadow-sm search col-6">
         <div class="input-group mb-3 w-75">
            <h4 class="me-4">Items</h4>
            <input type="text" class="form-control" placeholder="Search" aria-label="">
            <span class="input-group-text">
               <i class="bi bi-search"></i>
            </span>
         </div>

         <div class="js-products items d-flex">
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

      <div class="bg-light col-6">
         <center>
            <h4>Cart <span class="badge bg-primary">5</span></h4>
         </center> 
         <table class="table table-striped table-hover">
            <tr>
               <th>Image</th>
               <th>Description</th>
               <th>Qty</th>
               <th>Amount</th>
            </tr>
         </table>
      </div>
   </div>
</div>
    

<?php require viewsPath('partials/footer'); ?>  
