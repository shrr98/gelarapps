<nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-size: 20px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/" ><img style=" height: 50px;" src="http://gelarapps.local/assets/logo.png"></a>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link" href="<?= $this->url->get('beranda') ?>">Beranda <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= $this->url->get('komunitas') ?>">Komunitas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= $this->url->get('pagelaran') ?>">Pagelaran</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="<?= $this->url->get('profil') ?>"><?= $this->session->get('auth')['username'] ?></a>
        </li> -->
        <li class="nav-item dropdown submenu">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?= $this->url->get('profil') ?>"><?= $this->session->get('auth')['username'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="nav-item"><a class="nav-link" href="<?= $this->url->get('logout') ?>">Logout</a></li>
                            </ul>
                        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="<?= $this->url->get('logout') ?>">Logout</a>
        </li> -->
      </ul>
  </div>
  </nav>
