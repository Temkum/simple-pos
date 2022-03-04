<?php
require viewsPath('partials/header');
?>

<div class="row container-fluid">
  <h1 class="text-center">Admin dashboard</h1>
  <div class="me-3 col-xs-12 col-sm-4 col-md-3 col-lg-2 m-sm-2">
    <ul class="list-group">
      <a href="index.php?page_name=admin&tab=dashboard">
        <li class="list-group-item <?= !$tab || $tab == 'dashboard' ? 'active' : ''?>">
          <i class="bi bi-grid"></i> Dashboard
        </li>
      </a>

      <a href="index.php?page_name=admin&tab=users">
        <li class="list-group-item <?= $tab == 'users' ? 'active' : ''?>">
          <i class="bi bi-people"></i> Users
        </li>
      </a>

      <a href="index.php?page_name=admin&tab=products">
        <li class="list-group-item <?= $tab == 'products' ? 'active' : ''?>">
          <i class="bi bi-stack"></i> Products
        </li>
      </a>

      <a href="index.php?page_name=logout">
        <li class="list-group-item ">
          <i class="bi bi-box-arrow-left"></i> Logout
        </li>
      </a>
    </ul>
  </div>

  <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 border p-2">
    <h4><?= strtoupper($tab)?></h4>
  </div>

</div>

<?php
    require viewsPath('partials/footer');