a:9:{i:0;s:2442:"<!DOCTYPE html>
<html>
	<head>
        <!--<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?= $this->url->get('css/bootstrap.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Courgette|EB+Garamond|Charmonman" rel="stylesheet"> 

<link href="<?= $this->url->get('css/style.css') ?>" rel="stylesheet">
<link href="<?= $this->url->get('css/style1.css') ?>" rel="stylesheet">
<link href="<?= $this->url->get('css/style2.css') ?>" rel="stylesheet">

<script src="<?= $this->url->get('js/jquery.js') ?>"></script>
<script src="<?= $this->url->get('js/script.js') ?>"></script>

<script src="<?= $this->url->get('js/bootstrap.min.js') ?>"></script>

<script src="<?= $this->url->get('js/jquery.steps.js') ?>"></script>



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://unpkg.com/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Courgette|EB+Garamond|Charmonman" rel="stylesheet"> 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        ";s:17:"additional_header";N;i:1;s:23:"
		<title>GelarApps - ";s:5:"title";N;i:2;s:2777:"</title>
	</head>
	<body>
        
        <?php if ($this->session->has('auth')) { ?>
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

        <?php } else { ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-size: 20px;">
    <a class="navbar-brand" href="/" ><img style=" height: 50px;" src="http://gelarapps.local/assets/logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="<?= $this->url->get('login') ?>">Masuk <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= $this->url->get('signup') ?>">Daftar</a>
        </li>
      </ul>
    </div>
  </nav>
<nav>
        <?php } ?>

		";s:7:"content";N;i:3;s:21:"

    </body>
    ";s:6:"footer";N;i:4;s:9:"
</html>";}