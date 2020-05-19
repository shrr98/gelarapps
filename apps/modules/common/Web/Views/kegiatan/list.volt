{% extends "layouts/base.volt" %}

{% block title %}Kegiatan{% endblock %}

{% block content %}
    {{ this.flash.output() }}
    <h1 align="center">Kegiatan</h1>
    <div>
        <ul>
            {% for item in items %}
                <li>
                    <h5>
                        <a href="{{url('kegiatan/lihat/'~item.id)}}">{{item.judul}}</a>
                    </h5>
                        {{ date('d-M-Y', strtotime(item.waktu_mulai)) }} 
                </li>
            {% endfor %}
        </ul>
    </div>
{% endblock %}