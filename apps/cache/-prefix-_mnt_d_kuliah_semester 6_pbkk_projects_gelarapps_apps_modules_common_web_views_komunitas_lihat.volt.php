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
        
		<title>GelarApps - Komunitas : <?= $item->ko->nama_komunitas ?></title>
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

		
    <h1>Komunitas > <?= $item->ko->nama_komunitas ?></h1>
    <?php if (isset($tergabung)) { ?>
        <?php if ($tergabung->role == 1) { ?>
            <?= $this->flash->success('Admin') ?>
        <?php } elseif ($tergabung->verified == 1) { ?>
            <?= $this->flash->warning('Anggota') ?>
        <?php } ?>
    <?php } ?>
    <?= $this->tag->image(['data/komunitas/' . $item->ko->photo_path, 'width' => '30%', 'alt' => 'data/komunitas/' . $item->ko->photo_path]) ?>
    <?php if (isset($tergabung)) { ?>
        <?php if ($tergabung->role == 1) { ?>
            <button data-toggle='modal' data-target='#deleteModal'>Hapus Foto</button>
            <button data-toggle='modal' data-target='#changeModal'>Ubah Foto</button>

            <div class="modal" id="deleteModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hapus Foto Komunitas</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus foto komunitas?</p>
                            <form id='form-delete' action='/komunitas/deletephoto' method='post'>
                                <input type="hidden" name="id_komunitas" value=<?= $item->ko->id ?>>
                                <input type="submit" value="Hapus" name='deletephoto'>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="changeModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah Foto Komunitas</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id='form-delete' action='/komunitas/changephoto' method='post' enctype="multipart/form-data">
                                <input type="hidden" name="id_komunitas" value=<?= $item->ko->id ?>>
                                <input type="file" name="photo" id="photo">
                                <input type="submit" value="Ubah" name='changephoto'>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <div>
        <table>
            <tr>
                <td>
                    Kategori
                </td>
                <td>
                    <?= $item->nama_kategori ?>
                </td>
            </tr>
            <tr>
                <td>
                    Pemilik
                </td>
                <td>
                    <?= $item->ko->owner ?>
                </td>
            </tr>
            <tr>
                <td>
                    Alamat
                </td>
                <td>
                    <?= $item->ko->alamat ?>
                </td>
            </tr>
            <tr>
                <td>
                    Deskripsi
                </td>
                <td>
                    <?= $item->ko->deskripsi ?>
                </td>
            </tr>
        </table>
    </div>
    <?php if ($tergabung == null) { ?>
        <form action="/komunitas/gabung" method="POST">
            <input type="hidden" name="id_komunitas" value=<?= $item->ko->id ?>>
            <input class='btn btn-primary' type="submit" value="Gabung" name="gabung">
        </form>
    <?php } elseif ($tergabung->verified == 1) { ?>
        <button class='btn btn-secondary' disabled>Tergabung</button>
        <a href="<?= $this->url->get('komunitas/anggota/' . $item->ko->id) ?>">
            <button class="btn btn-primary">Lihat Anggota</button>
        </a>
        <?php if ($tergabung->role == 1) { ?>
        <a href="<?= $this->url->get('komunitas/edit/' . $item->ko->id) ?>">
            <button class="btn btn-info">Sunting Detail</button>
        </a>
        <a href="<?= $this->url->get('pagelaran/buat/' . $item->ko->id) ?>">
            <button class="btn btn-info">Buat Pagelaran</button>
        </a>
        <a href="<?= $this->url->get('kegiatan/buat/' . $item->ko->id) ?>">
            <button class="btn btn-info">Buat Kegiatan</button>
        </a>
        <?php } ?>
    <?php } else { ?>
        <button class='btn btn-secondary' disabled>Menunggu Konfirmasi</button>
    <?php } ?>
    <a href="<?= $this->url->get('pagelaran/list/' . $item->ko->id) ?>">
        <button class="btn btn-primary">Lihat Pagelaran</button>
    </a>
    <a href="<?= $this->url->get('kegiatan/list/' . $item->ko->id) ?>">
        <button class="btn btn-primary">Lihat Kegiatan</button>
    </a>

    <?php if ($this->session->has('auth') && isset($tergabung) && $tergabung->role == 1) { ?>
    <div class="container-fluid">
        <h3>Permintaan Bergabung</h3>
        <div>
            <ul>
                <?php foreach ($permintaan as $item) { ?>
                <li class='list-group-item'>
                    <span>
                        <form action="<?= $this->url->get('komunitas/verifikasi') ?>" method="POST">
                        <a href="/user/<?= $item->id_user ?>"><?= $item->id_user ?></a> ingin bergabung.
                        <input type="hidden" name="id_user" value=<?= $item->id_user ?>>
                        <input type="hidden" name="id_komunitas" value=<?= $item->id_komunitas ?>>
                        <input class='btn btn-success' type="submit" value="Terima" name="terima">
                        <input class='btn btn-danger' type="submit" value="Tolak" name="tolak">
                        </form>
                    </span>
                </li>
                <?php } ?>
    
            </ul>
        </div>
        <?php } ?>
        
    </div>


    </body>
    
</html>