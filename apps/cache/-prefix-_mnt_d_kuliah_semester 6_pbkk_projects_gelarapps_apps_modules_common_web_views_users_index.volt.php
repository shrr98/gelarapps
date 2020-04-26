<!DOCTYPE html>
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
		<title> GelarApps</title>
	</head>
	<body>
		<nav>
			<div class="logo"><a href="<?= $this->url->get('') ?>"><img src="assets/logo.png" alt="logo"></a></div>
			<div class="nav-cont-left">
				<ul>
					<li><a href="<?= $this->url->get('') ?>">Home</a></li>
					<li>Learn
						<ul>
							<li><a href="<?= $this->url->get('tipsntrick') ?>">Tips and Tricks</a></li>
							<li><a href="<?= $this->url->get('care') ?>">Cat Care</a></li>
							<li><a href="<?= $this->url->get('adopt') ?>">Adopt</a></li>
						</ul>
					</li>
					<li><a href="<?= $this->url->get('report') ?>">Find A Cat ?</a></li>
					<li><a href="<?= $this->url->get('donate') ?>">Donate</a></li>
					<li><a href="<?= $this->url->get('about') ?>">About</a></li>
				<ul>
			</div>

			<div class="nav-cont-right">
				<ul>
				<?php if ($this->session->has('auth')) { ?> 
					<li><a href="<?= $this->url->get('profile') ?>"><?= $this->session->get('auth')['username'] ?></a></li>
					<li><a href="<?= $this->url->get('logout') ?>">Logout</a></li>

				<?php } else { ?>
					<li><a href="<?= $this->url->get('login') ?>">Login</a></li>
					<li><a href="<?= $this->url->get('register') ?>">Signup</a></li>

				<?php } ?>
		</nav>

		

		
		</body>
</html>