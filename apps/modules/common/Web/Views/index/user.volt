{% extends "layouts/base.volt" %}

{% block title %}Beranda{% endblock %}


{% block content %}
    <h1>Temukan komunitas sesuai <b>minatmu</b> dengan GelarApps!</h1>
    <h2>
        Komunitas
        <a href="/komunitas/cari"><button class='btn btn-primary'>Lihat Semua</button></a>
    </h2>
    <div>
        <ul>
            {% for komunitas in komunitases %}
                <li>
                    <h5>
                        <a href="{{url('komunitas/lihat/'~komunitas.id)}}">{{komunitas.nama_komunitas}}</a>
                    </h5>
                    <h6>
                        <a href="{{url('komunitas/kategori/'~komunitas.id_kat)}}">
                            {{komunitas.kategori}}
                        </a>
                    </h6>
                </li>
            {% endfor %}
        </ul>
    </div>
    <h2>
        Pagelaran
        <a href="/pagelaran/list/semua"><button class='btn btn-primary'>Lihat Semua</button></a>
    </h2>
    <div>
        <ul>
            {% for pagelaran in pagelarans %}
                <li>
                    {{ image('data/pagelaran/'~pagelaran.pa.photo_path, "width" : "10%")}}
                    <h5>
                        <a href="{{url('pagelaran/lihat/'~pagelaran.pa.id)}}">{{pagelaran.pa.judul}}</a>
                    </h5>
                    <h6>
                        <a href="{{url('komunitas/kategori/'~pagelaran.id_kat)}}">
                            {{ pagelaran.nama_kategori }} 
                        </a>
                        - 
                        <a href="{{url('komunitas/lihat/'~pagelaran.pa.komunitas)}}">
                            {{pagelaran.nama_komunitas}}
                        </a>
                    </h6>
                        {{ date('d-M-Y', strtotime(pagelaran.pa.waktu_mulai)) }} 
                </li>
            {% endfor %}
        </ul>
    </div>
{% endblock %}