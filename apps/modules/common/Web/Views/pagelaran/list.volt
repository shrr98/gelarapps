{% extends "layouts/base.volt" %}

{% block title %}Pagelaran{% endblock %}

{% block content %}
    <h1>Pagelaran</h1>
    <div>
        <ul>
            {% for item in items %}
                <li>
                    {{ image(url('public/data/pagelaran/'~item.pa.photo_path))}}
                    <h5>
                        <a href="{{url('pagelaran/lihat/'~item.pa.id)}}">{{item.pa.judul}}</a>
                    </h5>
                    <h6>
                        <a href="{{url('komunitas/kategori/'~item.id_kat)}}">
                            {{ item.nama_kategori }} 
                        </a>
                        - 
                        <a href="{{url('komunitas/lihat/'~item.pa.komunitas)}}">
                            {{item.nama_komunitas}}
                        </a>
                    </h6>
                        {{ date('d-M-Y', strtotime(item.pa.waktu_mulai)) }} 
                </li>
            {% endfor %}
        </ul>
    </div>
{% endblock %}