{% extends "layouts/base.volt" %}

{% block title %}Komunitas{% endblock %}

{% block content %}
    <h1>Komunitas</h1>
    <div class='row'>
        <div class='col-md-4'>
            <a href="/komunitas/list/saya">Komunitas Saya</a>
        </div>
        <div class='col-md-4'>
            <a href="/komunitas/cari">Cari Komunitas</a>
        </div>
        <div class='col-md-4'>
            <a href="/komunitas/buat">Buat Komunitas</a>
        </div>
    </div>
{% endblock %}