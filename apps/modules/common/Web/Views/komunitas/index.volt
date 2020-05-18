{% extends "layouts/base.volt" %}

{% block title %}Komunitas{% endblock %}

{% block content %}

<div class="jumbotron" style="height: 300px;">

    <h1 align="center" style= "font-size: 30px;">Komunitas</h1>

<div class="row" style="margin-top: 30px;">
    <div class="card text-center col-md-4" align="center">
      <div class="card-header">
        Komunitas Saya
      </div>
      <div class="card-body">
        <h5 class="card-title">Lihat Komunitas Saya</h5>
        <p class="card-text">Anda dapat melihat Komunitas yang telah Anda buat.</p>
        <a href="/komunitas/list/saya" class="btn btn-primary">Komunitas Saya</a>
      </div>
    </div>
    <div class="card text-center col-md-4" align="center">
      <div class="card-header">
        Cari Komunitas
      </div>
      <div class="card-body">
        <h5 class="card-title">Cari Komunitas</h5>
        <p class="card-text">Anda dapat mencari Komunitas berdasarkan dengan kategorinya.</p>
        <a href="/komunitas/cari" class="btn btn-primary">Cari Komunitas</a>
      </div>
    </div>
    <div class="card text-center col-md-4" align="center">
      <div class="card-header">
        Buat Komunitas
      </div>
      <div class="card-body">
        <h5 class="card-title">Buat Komunitas</h5>
        <p class="card-text">Anda dapat membuat Komunitas sesuai dengan kategori yang telah ada.</p>
        <a href="/komunitas/buat" class="btn btn-primary">Buat Komunitas</a>
      </div>
    </div>
</div>
</div>
    
{% endblock %}