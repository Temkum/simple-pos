 <?php
 require viewsPath('partials/header');
    ?>

    <div class="signup container-fluid col-lg-4 col-xg-5 col-md-6 col-sm-10 border mt-5 p-3 shadow"> 
       <center class="text-uppercase mb-5">
         <span><i class="bi bi-person-circle icon-style"></i></span>
         <h3>User registration</h3>
         <div><?= esc(APP_NAME) ?></div>
      </center>

      <form action="" method="POST">
         <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Name</span>
                <input type="text" class="form-control" placeholder="Enter name" aria-label="Username" autofocus>
             </div>
       
             <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Username</span>
                <input type="text" class="form-control" placeholder="Enter username" aria-label="Username">
             </div>

             <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email</span>
                <input type="email" class="form-control" placeholder="name@example.com" aria-label="Email">
             </div>

             <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password">
             </div><div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Retype Password</span>
                <input type="password" class="form-control" placeholder="Repeat password" aria-label="Password">
             </div>
             <br>
             <button class="btn btn-primary">Signup</button>
             <button class="btn btn-danger float-end">Cancel</button>
      </form>

      <div class="row mt-3">
      <span>
            Already have an account? Login <a href="index.php?page_name=login"> here</a>
         </span>         
      </div>
   </div>
             

<?php require viewsPath('partials/footer');
  
