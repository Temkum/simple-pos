<?php

class Graph
{
  public $canvasX = 1000;
  public $canvasY = 400;
  public $font_size = 16;

  public function display($data)
  {
    $canvasX = $this->canvasX;
    $canvasY = $this->canvasY;

    if (!is_array($data) || empty($data)) {
      # code...
      echo 'Data must be an array and contain data!';
      return;
    }

    $xText = array_keys($data);

    $max_Y = max($data);
    $max_X = count($data);

    $multiplier_Y = $canvasY / $max_Y;
    $multiplier_X = $canvasX / $max_X;

    // create a num to use since key is not a number
    $num = 1;
    $points = "0, $canvasY ";

    foreach ($data as $key => $value) {
      $points .= $multiplier_X * $num . "," . $canvasY - ($value * $multiplier_Y) . " ";
      $num++;
    }
    $points .= "$canvasX, $canvasY";

    $extraX = 100;
    $extraY = 60;
?>
<svg class="border" viewBox="0 -<?= $extraY ?> <?= $canvasX + $extraX ?> <?= $canvasY + ($extraY * 2) ?>">

  <!-- top to bottom lines -->
  <?php
      for ($i = 0; $i < $max_X; $i++) {
        $x1 = $i * $multiplier_X;
        $y1 = 0;

        $x2 = $x1;
        $y2 = $canvasY;
      ?>
  <polyline points="<?= $x1 ?>,<?= $y1 ?> <?= $x2 ?>,<?= $y2 ?>" />

  <?php
      }
      ?>

  <!-- left to right lines -->
  <?php
      $max_lines = count($data);
      $Y_segment = round($canvasY / $max_lines); //

      for ($i = 0; $i < $max_lines; $i++) {
        $x1 = 0;
        $y1 = $i * $Y_segment;
        $x2 = $canvasX;
        $y2 = $y1;
      ?>
  <polyline points="<?= $x1 ?>,<?= $y1 ?> <?= $x2 ?>,<?= $y2 ?>" />
  <?php
      }
      ?>

  <polyline points="<?= $points ?>" />

  <?php
      $num = 1;
      $points = "0,$canvasY ";
      foreach ($data as $key => $value) {
      ?>
  <circle r="8" cx="<?= $multiplier_X * $num ?>" cy="<?= $canvasY - ($value * $multiplier_Y) ?>" />
  <?php
        $num++;
      }
      ?>

  <!-- x text values-->
  <?php
      $num = 0;
      foreach ($xText as $value) : $num++ ?>
  <text x="<?= ($num * $multiplier_X) - $multiplier_X / 5 ?>" y="<?= $canvasY + ($extraY / 1.5) ?>"><?= $value ?></text>
  <?php endforeach; ?>

  <!-- y text values -->
  <?php
      $max_lines = count($data);
      $Y_segment = round($canvasY / $max_lines); //
      $num = $max_Y;

      for ($i = 0; $i < $max_lines; $i++) {
        $x = $canvasX;
        $y = $i * $Y_segment;
        if (round($num) < 0) {
          break;
        }
      ?>
  <text x="<?= $x - ($multiplier_X / 20) ?>" y="<?= $y ?>"><?= round($num) ?></text>
  <?php
        $max_lines = $max_lines ? $max_lines : 1;
        $num -= $max_Y / $max_lines;
      }
      ?>
</svg>
<?php
  }
}