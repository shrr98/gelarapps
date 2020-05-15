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
                <li class=list-group-item>
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
    <div class='row'>
            {% for pagelaran in pagelarans %}
                    <div class="card col-md-2" style="width: 18rem;">
                        {{ image('data/pagelaran/'~pagelaran.pa.photo_path, "width" : "10%", "class" : "card-img-top")}}
                        <div class="card-body">
                          <h5 class="card-title">{{pagelaran.pa.judul}}</h5>
                          <p class="card-text">
                            <a href="{{url('komunitas/kategori/'~pagelaran.id_kat)}}">
                                {{ pagelaran.nama_kategori }} 
                            </a>
                            - 
                            <a href="{{url('komunitas/lihat/'~pagelaran.pa.komunitas)}}">
                                {{pagelaran.nama_komunitas}}
                            </a>
                          </p>
                          <p>
                              {{ date('d-M-Y', strtotime(pagelaran.pa.waktu_mulai)) }} 
                          </p>
                          <a href="{{url('pagelaran/lihat/'~pagelaran.pa.id)}}" class="btn btn-primary">Lihat</a>
                        </div>
                    </div>
            {% endfor %}
    </div>
{% endblock %}