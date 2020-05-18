{% extends "layouts/base.volt" %}

{% block title %}Cari Komunitas{% endblock %}

{% block content %}

    <h1 align="center" style="font-size: 30px;">Cari Komunitas</h1>

     <div class="jumbotron">

        <div class="card-group">
            {% for item in items %}
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><a href="{{url('komunitas/kategori/'~item.id)}}">{{item.kategori}}</a></h5>
            </div>
            {% endfor %}
          </div>
    </div>

   <!--  <div>
        <ul>
            {% for item in items %}
                <li>
                    <h5>
                        <a href="{{url('komunitas/kategori/'~item.id)}}">{{item.kategori}}</a>
                    </h5>
                </li>
            {% endfor %}
        </ul>
    </div> -->
{% endblock %}