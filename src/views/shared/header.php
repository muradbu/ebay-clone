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
        <?php
        //TODO - insert loggedIn state
        if (false) {
          echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"/inloggen\">Inloggen</a></li>";
        } else if (true) {
          ?>
          <li class="nav-item dropdown">
            <a class=" active nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Mijn account
            </a>
            <div class="dropdown-menu">
              <!-- TODO - Goede linkjes invoegen -->
              <a class="dropdown-item" href="/account">Mijn gegevens</a>
              <a class="dropdown-item" href="/veilignen">Mijn veilingen</a>
              <a class="dropdown-item" href="/biedingen">Mijn biedingen</a>
              <a class="dropdown-item" href="/uitloggen">Uitloggen</a>
            </div>
          </li>
        <?php
        }
        ?>
        <li class="active nav-item position-static bg-primary">
          <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Bekijk alle rubrieken
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
