{% extends "layouts/base.volt" %}

{% block title %}Cari Komunitas{% endblock %}

{% block content %}

    <h1 align="center" style="font-size: 30px;">Cari Komunitas > {{kategori}}</h1>

    <div class="jumbotron">

        <div class="card-group">
            {% for item in items %}
          <div class="card">
            <div class="card-body">
              <p class="card-text"><a href="{{url('komunitas/lihat/'~item.id)}}">{{item.nama_komunitas}}</a></p>
            </div>
            {% endfor %}
          </div>
    </div>

{% endblock %}