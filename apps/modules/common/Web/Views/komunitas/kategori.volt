{% extends "layouts/base.volt" %}

{% block title %}Cari Komunitas{% endblock %}

{% block content %}
    <h1>Cari Komunitas > {{kategori}}</h1>
    <div>
        <ul>
            {% for item in items %}
                <li>
                    <h5>
                        <a href="{{url('komunitas/lihat/'~item.id)}}">{{item.nama_komunitas}}</a>
                    </h5>
                </li>
            {% endfor %}
        </ul>
    </div>
{% endblock %}