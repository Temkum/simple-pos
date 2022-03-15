 <?php
  require viewsPath('partials/header');
  ?>
 <div class="container-fluid shadow-sm">

   <div class="d-flex">
     <div class="bg-gray shadow-sm col-md-8 col-lg-6 me-3">
       <div class="input-group mb-3 w-75 p-2">
         <h4 class="me-4">Items</h4>
         <input onkeyup="checkForEnterKey(event)" type="text" class="form-control js-search" placeholder="Search"
           aria-label="" oninput="searchItem(event)">
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
         <h4>Cart <span class="badge bg-primary br-20 js-item-count">0</span></h4>
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
             <!-- add items dynamically using js -->
           </tbody>
         </table>
       </div>

       <div class="total bold p-3 js-total">
         Total: $0.00
       </div>

       <!-- checkout -->
       <div class="checkout p-4">
         <button class="btn btn-success w-100 py-3 my-3" onclick="showModal('amount_paid')">Checkout</button>
         <button class="btn btn-warning w-100 clear-items" onclick="clearCart()">Clear items</button>
       </div>
     </div>
   </div>

 </div>

 <!-- modals -->
 <div class="modals hide js-paid-amt" onclick="hideModal(event, 'amount_paid')" role="close-button">

   <div class="modal-box js-modal">
     <!-- <h5 class="bold">Checkout <button class="btn float-end btn-outline-lg" onclick="hideAmtModal(event)"
         role="close-button">X</button></h5> -->
     <h5 class="bold">Checkout <i class="btn float-end btn-outline-lg bi bi-x-lg"
         onclick="hideModal(event, 'amount_paid')" role="close-button"></i></h5>
     <br>
     <input onkeyup="if(event.keyCode == 13) validateAmountPaid(event)" type="number" name="" id="jsChange"
       class="form-control mb-2 js-cash-input" placeholder="Enter amount paid">
     <br>
     <button class="btn btn-secondary" onclick="hideModal(event, 'amount_paid')" role="close-button">Cancel</button>
     <button class="btn btn-primary float-end" onclick="validateAmountPaid(event)">Next</button>
   </div>
 </div>

 <!-- change modal -->
 <div class="modals hide js-change" onclick="hideModal(event, 'change')" role="close-button">
   <div class="modal-box js-modal">
     <h5 class="bold">Change <i class="btn float-end btn-outline-lg bi bi-x-lg" onclick="hideModal(event, 'change')"
         role="close-button"></i></h5>
     <br>
     <div class="js-change-input text-center form-control font-4"></div>
     <br>
     <center>
       <button class="js-close-btn btn btn-secondary btn-lg" onclick="validateAmountPaid(event)"
         role="close-button">Continue</button>
     </center>
   </div>
 </div>

 <?php require viewsPath('partials/footer'); ?>