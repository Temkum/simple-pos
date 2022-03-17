 <?php
  require viewsPath('partials/header');
  ?>

 <div class="signup container-fluid col-lg-4 col-xg-5 col-md-6 col-sm-10 border mt-5 p-3 shadow">
   <center class="text-uppercase mb-5">
     <span><i class="bi bi-person-circle icon-style mb-2"></i></span>
     <h3>Delete User</h3>
     <div><?= esc(APP_NAME) ?></div>

     <div class="alert alert-danger"><i class="bi bi-exclamation-triangle p-3"></i> Are you sure you want to delete this
       user?</div>
   </center>

   <?php if (is_array($row) && $row['deletable']) : ?>
   <form action="" method="POST" enctype="">
     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Name</span>
       <div class="form-control"><?= esc($row['name']) ?></div>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Username</span>
       <div class="form-control"><?= esc($row['username']) ?></div>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Email</span>
       <div class="form-control"><?= esc($row['email']) ?></div>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Gender</span>
       <div class="form-control"><?= esc($row['gender']) ?></div>
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon1">Role</span>
       <div class="form-control"><?= esc($row['role']) ?></div>
     </div>

     <br>
     <a href="index.php?page_name=admin&tab=users">
       <button class="btn btn-secondary" type="button">Go back</button>
     </a>
     <button class="btn btn-danger float-end" type="submit">Delete</button>
   </form>
   <?php else : ?>
   <?php if (is_array($row) && $row['deletable']) : ?>
   <div class="alert alert-info text-center mb-3">User was not found!</div>
   <?php else : ?>
   <div class="alert alert-info text-center mb-3">User cannot be deleted!</div>
   <?php endif; ?>

   <a href="index.php?page_name=admin&tab=users">
     <button class="btn btn-secondary" type="button">Go back</button>
   </a>
   <?php endif; ?>
 </div>

 <?php require viewsPath('partials/footer');