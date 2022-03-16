<nav class="navbar navbar-expand-lg navbar-light bg-light w-35">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="bi bi-microsoft"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?page_name=home">Dashboard</a>
        </li>

        <?php if (Auth::access('admin')) : ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page_name=admin">Admin</a>
        </li>
        <?php endif; ?>

        <?php if (!Auth::loggedIn()) : ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page_name=login">Login</a>
        </li>
        <?php endif; ?>

        <?php if (Auth::loggedIn()) : ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page_name=signup">Create user</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="index.php?page_name=pos" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Hi, <?= auth('username') ?> (<?= Auth::getUserData('role') ?>)
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page_name=profile">Profile</a></li>
            <li><a class="dropdown-item" href="index.php?page_name=settings">Settings</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="index.php?page_name=logout">Logout</a></li>
            <?php endif; ?>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>