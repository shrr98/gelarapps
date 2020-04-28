{% extends "layouts/base.volt" %}

{% block title %}Cari Komunitas{% endblock %}

{% block content %}
    <h1>Cari Komunitas</h1>
    <div>
        <ul>
            {% for item in items %}
                <li>
                    <h5>
                        <a href="{{url('komunitas/kategori/'~item.id)}}">{{item.kategori}}</a>
                    </h5>
                </li>
            {% endfor %}
        </ul>
    </div>
{% endblock %}