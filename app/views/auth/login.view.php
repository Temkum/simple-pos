 <?php
 require viewsPath('partials/header');
    ?>

    <div class="signup container-fluid col-lg-4 col-xg-6 col-md-6 col-sm-8 border mt-5 p-3 shadow"> 
       <center class="text-uppercase mb-5">
         <span><i class="bi bi-person-circle icon-style"></i></span>
         <h3>User Login</h3>
         <div><?= esc(APP_NAME) ?></div>
      </center>

      <form action="" method="POST">
         <div class="input-group mb-3">
             <span class="input-group-text" id="basic-addon1">Email</span>
             <input type="email" class="form-control <?= !empty($errors['email']) ? 'border-danger' : '' ?>" placeholder="Enter email" aria-label="Email" autofocus required name="email">
             <?php if (!empty($errors['email'])) : ?>
               <small class="text-danger col-12 p-1"><?= $errors['email'] ?></small>
             <?php endif; ?>
         </div>

          <div class="input-group mb-3">
             <span class="input-group-text" id="basic-addon1">Password</span>
             <input type="password" class="form-control <?= !empty($errors['password']) ? 'border-danger' : '' ?>" placeholder="Enter password" aria-label="Password" required name="password">
             <?php if (!empty($errors['password'])) : ?>
               <small class="text-danger col-12 p-1"><?= $errors['password'] ?></small>
             <?php endif; ?>
          </div>
          <br>

          <div class="d-flex  justify-content-center">
              <button class="btn btn-primary btn-lg login-btns">Login</button>
          </div>         
      </form>

      <div class="row mt-3">
         <span>
            Don't have an account? <a href="index.php?page_name=signup">Signup here</a>
         </span>         
      </div>
      </div>
             

<?php require viewsPath('partials/footer');
  
