 <?php
  require viewsPath('partials/header');
  ?>
 <br>
 <center>
   <h1 class="mb-3"><i class="bi bi-exclamation-triangle"></i> Access denied!</h1>
   <div class="text-center"><?= Auth::getMessage() ?></div>
 </center>

 <?php
  require viewsPath('partials/footer');
  ?>