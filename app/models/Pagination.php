<?php

class Pagination
{
  protected $limit = 8;
  public $offset = 0;
  public $pg_steps = 3;

  public function __construct($limit = 8)
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

  public function display($rec_count = null)
  {
    // remove pagination if rec count is less than limit
    if (!$rec_count) {
      $rec_count = $this->limit;
    }

    if (!$rec_count < $this->limit) {
      return;
    }

    $page_number = $this->getPageNumber();
?>
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="<?= $this->createPageLink(1) ?>" aria-disabled="true">First</a>
    </li>
    <li class="page-item">
      <?Php
          $pg_num = $page_number - 1;
          $pg_num = ($pg_num < 1) ? 1 : $pg_num;
          ?>
      <a class="page-link" href="<?= $this->createPageLink($pg_num) ?>" tabindex="-1" aria-disabled="true">Prev</a>
    </li>

    <?php
        $p = $this->pg_steps;
        for ($i = 1; $i <= $this->pg_steps; $i++) {
          if (($page_number - $p) < 1) {
            $p--;
            continue;
          }

          echo '<li class="page-item"><a class="page-link"
                    href="' . $this->createPageLink($page_number - $p) . '">' . $page_number - $p . '</a>
          </li>';
          $p--;
        }
        ?>

    <li class="page-item active"><a class="page-link"
        href="<?= $this->createPageLink($page_number) ?>"><?= $page_number ?></a>
    </li>

    <?php
        for ($i = 1; $i < $this->pg_steps; $i++) {
          echo '<li class="page-item"><a class="page-link"
                    href="' . $this->createPageLink($page_number + $i) . '">' . $page_number + $i . '</a>
          </li>';
        }
        ?>

    <li class="page-item">
      <a class="page-link" href="<?= $this->createPageLink($this->getPageNumber() + 1) ?>">Next</a>
    </li>
  </ul>
</nav>
<?php
  }
}