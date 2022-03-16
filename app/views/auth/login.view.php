 <?php
  require viewsPath('partials/header');
  ?>

 <div class="signup container-fluid col-lg-4 col-xg-6 col-md-6 col-sm-8 border mt-5 p-3 shadow">
   <center class="text-uppercase mb-5">
     <span><i class="bi bi-person-circle icon-style"></i></span>
     <h3>Login</h3>
     <div><?= esc(APP_NAME) ?></div>
   </center>

   <form action="" method="POST">
     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Username</span>
       <input name="username" type="text" class="form-control <?= !empty($errors['username']) ? 'border-danger' : '' ?>"
         placeholder="Enter username" aria-label="Email" value="<?= setValue('username') ?>" autofocus required>
       <?php if (!empty($errors['username'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['username'] ?></small>
       <?php endif; ?>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Password</span>
       <input name="pwd" type="password" class="form-control <?= !empty($errors['pwd']) ? 'border-danger' : '' ?>"
         placeholder="Enter password" aria-label="Password" required>
       <?php if (!empty($errors['pwd'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['pwd'] ?></small>
       <?php endif; ?>
     </div>
     <br>

     <div class="d-flex justify-content-center">
       <button class="btn btn-primary btn-lg login-btns">Login</button>
     </div>
   </form>

   <div class="row mt-3">
     <span>
       Don't have an account? <a href="index.php?page_name=signup">Create user</a>
     </span>
   </div>
 </div>


 <?php require viewsPath('partials/footer');