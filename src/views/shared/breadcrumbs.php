<div class="col-md-12 col-sm-12 col-lg-12">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><a href="/">Home</a></li>
      <?php
      $crumbs = explode("/", $_SERVER["REQUEST_URI"]);

      foreach ($crumbs as $crumb) {
        if ($crumb != "") {
          echo "<li class='breadcrumb-item'><a href='#'>" . ucfirst(str_replace(array(".php", "_"), array("", " "), $crumb) . ' ') . "</a></li>";
        }
      }
      ?>
    </ol>
  </div>
</div>