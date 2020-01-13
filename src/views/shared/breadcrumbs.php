  <div aria-label="breadcrumb">
    <ol class="breadcrumb bg-light mb-0">
      <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
      <?php
      $crumbs = explode("/", $_SERVER["REQUEST_URI"]);

      foreach ($crumbs as $crumb) {
        if ($crumb != "") {
          if ($crumb == end($crumbs))
          {
            echo "<li class='breadcrumb-item'><a href='#'>" . ucfirst(str_replace(array(".php", "_"), array("", " "), $crumb) . ' ') . "</a></li>";
          }
          else{
              echo "<li class='breadcrumb-item'><a href='../".strtolower($crumb)."'>" . ucfirst(str_replace(array(".php", "_"), array("", " "), $crumb) . ' ') . "</a></li>";
          }          
        }
      }
      ?>
    </ol>
  </div>