{% extends "layouts/base.volt" %}

{% block title %}Pagelaran{% endblock %}

{% block content %}
    <h1>Pagelaran</h1>
    <div class='row'>
        <div class='col-md-4'>
            <a href="/pagelaran/list/saya">Pagelaran Saya</a>
        </div>
        <div class='col-md-4'>
            <a href="/pagelaran/list/semua">Cari Pagelaran</a>
        </div>
    </div>
{% endblock %}