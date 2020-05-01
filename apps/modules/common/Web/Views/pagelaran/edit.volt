{% extends "layouts/base.volt" %}

{% block title %}Pagelaran{% endblock %}

{% block additional_header %}
    <link rel="stylesheet" href="{{ url('css/form.css') }}">
{% endblock %}

{% block content %}
<h1>Sunting Pagelaranmu</h1>

<div class="wrapper fadeInDown">
    <div id="formContent">
            <h3>Pagelaran</h3>
        <div class="notif">
            {{ this.flash.output() }}
        </div>
        {{ form.startForm() }}
        <input type="hidden" name="id" value={{id_pagelaran}}>
            {{ form.rendering('judul') }}
            {% if errmsg is defined and errmsg['judul'] is defined %}
                {{ flash.error(errmsg['judul']) }}
            {% endif %}

            {{ form.rendering('photo') }}
            {% if errmsg is defined and errmsg['photo'] is defined %}
                {{ flash.error(errmsg['photo']) }}
            {% endif %}
            
            <label for="waktu_mulai">Waktu Mulai</label>
            {{form.rendering('waktu_mulai')}}
            
            <label for="waktu_mulai">Waktu Selesai</label>
            {{ form.rendering('waktu_selesai')}}
        
            {{ form.rendering('komunitas') }}
            {{ form.rendering('creator') }}
            
            {{ form.rendering('tempat') }}
            {% if errmsg is defined and errmsg['tempat'] is defined %}
                {{ flash.error(errmsg['tempat']) }}
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