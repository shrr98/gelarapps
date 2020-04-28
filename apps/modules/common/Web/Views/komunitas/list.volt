{% extends "layouts/base.volt" %}

{% block title %}Komunitas{% endblock %}

{% block content %}
    <h1>Komunitas</h1>
    <div>
        <ul>
            {% for item in items %}
                <li>
                    <h5>
                        <a href="{{url('komunitas/lihat/'~item.id)}}">{{item.nama_komunitas}}</a>
                    </h5>
                    <h6>
                        <a href="{{url('komunitas/kategori/'~item.id_kat)}}">
                            {{item.kategori}}
                        </a>
                    </h6>
                </li>
            {% endfor %}
        </ul>
    </div>
{% endblock %}