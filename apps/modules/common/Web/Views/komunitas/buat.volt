{% extends "layouts/base.volt" %}

{% block title %}Komunitas{% endblock %}

{% block content %}
    <h1>Buat Komunitasmu</h1>
    {{ form.startForm() }}
        {{ form.rendering('nama_komunitas') }}
        {{ form.rendering('photo') }}
        {{ form.rendering('kategori') }}
        {{ form.rendering('alamat') }}
        {{ form.rendering('deskripsi') }}
        {{ form.rendering('Buat') }}
    {{ form.endForm() }}

{% endblock %}