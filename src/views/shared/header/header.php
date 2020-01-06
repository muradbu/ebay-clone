<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="<?php echo Config::ROOT_FOLDER . "/img/logo.svg" ?>" alt="EenmaalAndermaal" height="43">
      EenmaalAndermaal
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item position-static">
          <?php
          if (!isset($_SESSION["authenticated"])) {
            echo "<li class='nav-item'><a class='nav-link text-white' href='/inloggen'>Inloggen</a></li>";
          } else if (true) {
            require_once("views/shared/header/productDropdown.php");
          ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Mijn account
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="/account">Mijn gegevens</a>
            <a class="dropdown-item" href="/veilingen">Mijn veilingen</a>
            <a class="dropdown-item" href="/gebruiker/biedingen/0">Mijn biedingen</a>
            <a class="dropdown-item" href="/uitloggen">Uitloggen</a>
          </div>
        </li>
      <?php
          }
      ?>
      <li class="nav-item position-static bg-primary">
        <a href="#" class="nav-link dropdown-toggle d-none d-lg-block" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bekijk alle rubrieken
        </a>
        <a href="/rubrieken" class="nav-link d-lg-none">
          Bekijk alle rubrieken
        </a>
        <?php
        require("categoryDropdown.php");
        ?>
      </li>
      </ul>
    </div>
  </div>
</nav>