{% extends "layouts/base.volt" %}

{% block title %}Komunitas{% endblock %}

{% block additional_header %}
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
{% endblock %}

{% block content %}
<h1>Edit Komunitasmu</h1>

<div class="wrapper fadeInDown">
    <div id="formContent">
            <h3>Komunitas</h3>
        <div class="notif">
            {{ this.flash.output() }}
        </div>
        {{ form.startForm() }}
            {{ form.rendering('nama_komunitas') }}
            {% if errmsg is defined and errmsg['nama_komunitas'] is defined %}
                {{ flash.error(errmsg['nama_komunitas']) }}
            {% endif %}

            {{ form.rendering('kategori') }}
            {% if errmsg is defined and errmsg['kategori'] is defined %}
                {{ flash.error(errmsg['kategori']) }}
            {% endif %}

            {{ form.rendering('alamat') }}
            {% if errmsg is defined and errmsg['alamat'] is defined %}
                {{ flash.error(errmsg['alamat']) }}
            {% endif %}

            {{ form.rendering('deskripsi') }}
            {% if errmsg is defined and errmsg['deskripsi'] is defined %}
                {{ flash.error(errmsg['deskripsi']) }}
            {% endif %}
            
            {{ form.rendering('Simpan') }}
        {{ form.endForm() }}
    </div>
</div>
{% endblock %}