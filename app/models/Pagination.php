<?php

class Pagination
{
  protected $limit = 10;
  public $offset = 0;

  public function __construct($limit = 10)
  {
    $this->limit = (int)$limit;
    $page_number = $this->getPageNumber();
    $this->offset = ($page_number - 1) * $this->limit;

    // this returns the class
  }

  protected function getPageNumber()
  {
    $page_number = $_GET['page'] ?? 1; #null sale operator
    $page_number = (int)$page_number;

    if ($page_number < 1) {
      $page_number = 1;
    }

    return $page_number;
  }

  protected function createPageLink($page)
  {
    #reconstruct the url
    $url = "index.php?";
    $url2 = "";

    foreach ($_GET as $key => $value) {
      # code...
      if ($key == "page") {
        $url2 .= "&" . $key . "=$page";
      } else {
        $url2 .= "&" . $key . "=" . $value;
      }
    }

    $url2 = trim($url2, "&");

    if (!strstr($url2, "page=")) {
      $url2 .= "&page=$page";
    }
    $url .= $url2;

    return $url;
  }

  public function display()
  {
?>
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="<?= $this->createPageLink(1) ?>" aria-disabled="true">First</a>
    </li>
    <li class="page-item">
      <?Php
          $pg_num = $this->getPageNumber() - 1;
          $pg_num = ($pg_num < 1) ? 1 : $pg_num;
          ?>
      <a class="page-link" href="<?= $this->createPageLink($pg_num) ?>" tabindex="-1" aria-disabled="true">Prev</a>
    </li>
    <li class="page-item active"><a class="page-link" href="<?= $this->createPageLink(1) ?>">1</a></li>
    <li class="page-item" aria-current="page">
      <a class="page-link" href="<?= $this->createPageLink(2) ?>">2</a>
    </li>
    <li class="page-item"><a class="page-link" href="<?= $this->createPageLink(3) ?>">3</a></li>
    <li class="page-item">
      <a class="page-link" href="<?= $this->createPageLink($this->getPageNumber() + 1) ?>">Next</a>
    </li>
  </ul>
</nav>
<?php
  }
}