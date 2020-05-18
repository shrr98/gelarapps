{% extends "layouts/base.volt" %}

{% block title %}Komunitas{% endblock %}

{% block content %}
   
    <div class="jumbotron">

        <div class="card-group">
            {% for item in items %}
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Komunitas</h5>
              <p class="card-text"><a href="{{url('komunitas/lihat/'~item.id)}}">{{item.nama_komunitas}}</a></p>
              <p class="card-text">Kategori : <a href="{{url('komunitas/kategori/'~item.id_kat)}}">
                                {{item.kategori}}
                            </a></p>
            </div>
            {% endfor %}
          </div>
    </div>
{% endblock %}