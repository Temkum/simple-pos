 <?php
  require viewsPath('partials/header');
  ?>

 <?php
  if (!empty($_SESSION['referer'])) {
    $back_link = $_SESSION['referer'];
  } else {
    $back_link = "index.php?page_name=admin&tab=users";
  }
  ?>

 <div class="signup container-fluid col-lg-4 col-xg-5 col-md-6 col-sm-10 border mt-5 p-3 shadow">
   <center class="text-uppercase mb-5">
     <span><i class="bi bi-person-circle icon-style mb-2"></i></span>
     <h3>Edit User</h3>
     <div><?= esc(APP_NAME) ?></div>
   </center>

   <?php if (is_array($row)) : ?>
   <form action="" method="POST" enctype="">
     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Name</span>
       <input type="text" class="form-control <?= !empty($errors['name']) ? 'border-danger' : '' ?>"
         placeholder="Enter name" aria-label="Username" name="name" autofocus
         value="<?= setValue('name', $row['name']) ?>">
       <?php if (!empty($errors['name'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['name'] ?></small>
       <?php endif; ?>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Username</span>
       <input type="text" class="form-control <?= !empty($errors['username']) ? 'border-danger' : '' ?>"
         placeholder="Enter username" aria-label="Username" name="username"
         value="<?= setValue('username', $row['username']) ?>">
       <?php if (!empty($errors['username'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['username'] ?></small>
       <?php endif; ?>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Email</span>
       <input type="email" class="form-control <?= !empty($errors['email']) ? 'border-danger' : '' ?>"
         placeholder="Enter email address" aria-label="Email" name="email"
         value="<?= setValue('email', $row['email']) ?>">
       <?php if (!empty($errors['email'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['email'] ?></small>
       <?php endif; ?>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Gender</span>
       <select name="gender" id="" class="form-control">
         <option><?= ucfirst($row['gender']) ?></option>
         <option>male</option>
         <option>female</option>
       </select>
       <?php if (!empty($errors['gender'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['gender'] ?></small>
       <?php endif; ?>
     </div>

     <?php if (Auth::getUserData('role') == 'admin') : ?>
     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Role</span>
       <select name="role" id="" class="form-control">
         <option><?= $row['role'] ?></option>
         <option>admin</option>
         <option>supervisor</option>
         <option>cashier</option>
       </select>
       <?php if (!empty($errors['role'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['role'] ?></small>
       <?php endif; ?>
     </div>
     <?php endif; ?>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Password</span>
       <input type="password" class="form-control <?= !empty($errors['password']) ? 'border-danger' : '' ?>"
         placeholder="Password (Leave blank to not change)" aria-label="Password" name="password"
         value="<?= setValue('password', '') ?>">
       <?php if (!empty($errors['password'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['password'] ?></small>
       <?php endif; ?>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Retype Password</span>
       <input type="password" class="form-control <?= !empty($errors['repeat_pwd']) ? 'border-danger' : '' ?>"
         placeholder="Password (Leave blank to not change)" aria-label="Password" name="repeat_pwd"
         value="<?= setValue('repeat_pwd', '') ?>">
       <?php if (!empty($errors['repeat_pwd'])) : ?>
       <small class="text-danger col-12 p-1"><?= $errors['repeat_pwd'] ?></small>
       <?php endif; ?>
     </div>

     <br>

     <a href="<?= $back_link ?>">
       <button class="btn btn-warning" type="button">Go back</button>
     </a>
     <button class="btn btn-primary float-end" type="submit">Update</button>
   </form>
   <?php else : ?>
   <div class="alert alert-danger text-center mb-3">User was not found!</div>
   <a href="<?= $back_link ?>">
     <button class="btn btn-secondary" type="button"><i class="bi bi-arrow-left"></i> Go back</button>
   </a>
   <?php endif; ?>
 </div>

 <?php require viewsPath('partials/footer');