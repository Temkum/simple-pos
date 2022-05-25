 <?php
require viewsPath('partials/header');
?>

 <div class="signup container-fluid col-lg-4 col-xg-5 col-md-6 col-sm-10 border mt-5 p-3 shadow">
     <a href="index.php?page_name=admin&tab=users">
         <button class="btn btn-outline-secondary" type="button"><i class="bi bi-arrow-left"></i> Go back</button>
     </a>

     <center class="text-uppercase mb-5">
         <span><i class="bi bi-person-lines-fill icon-style mb-2"></i></span>
         <h5>User Profile</h5>
     </center>

     <?php if (is_array($row)): ?>

     <table class="table table-hover table-striped">
         <tr>
             <th>Username</th>
             <td>
                 <?=$row['username']?>
             </td>
         </tr>
         <tr>
             <th>Email</th>
             <td>
                 <?=$row['email']?>
             </td>
         </tr>
         <tr>
             <th>Gender</th>
             <td>
                 <?=$row['gender']?>
             </td>
         </tr>
         <tr>
             <th>Role</th>
             <td>
                 <?=$row['role']?>
             </td>
         </tr>
         <tr>
             <th>Date created</th>
             <td><?=getDateHuman($row['date'])?></td>
         </tr>
         <tr>
             <!-- <th>Profile picture</th> -->
             <td>
                 <img src="<?=cropImg($row['image'], 100, $row['gender'])?>" alt="" width="100">
             </td>
         </tr>
     </table>
     <a href="index.php?page_name=edit_user&id=<?=$row['id']?>">
         <button class="btn btn-primary" type="button">Edit</button>
     </a>

     <a href="index.php?page_name=delete_user&id=<?=$row['id']?>" class="float-end">
         <button class="btn btn-danger">Delete</button>
     </a>

     <?php else: ?>
     <div class="alert alert-danger text-center mb-3">User was not found!</div>
     <a href="index.php?page_name=admin&tab=users">
         <button class="btn btn-secondary" type="button"><i class="bi bi-arrow-left"></i> Go back</button>
     </a>
     <?php endif;?>
 </div>

 <?php require viewsPath('partials/footer');