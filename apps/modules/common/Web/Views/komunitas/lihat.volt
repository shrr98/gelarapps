{% extends "layouts/base.volt" %}

{% block title %}Komunitas : {{item.ko.nama_komunitas}}{% endblock %}

{% block content %}
    <h1>Komunitas > {{item.ko.nama_komunitas}}</h1>
    {% if tergabung is defined %}
        {% if tergabung.role == 1 %}
            {{ flash.success('Admin') }}
        {% elseif tergabung.verified == 1 %}
            {{ flash.warning('Anggota')}}
        {% endif %}
    {% endif %}
    {{ image('data/komunitas/'~item.ko.photo_path, "width" : "30%", 'alt' : 'data/komunitas/'~item.ko.photo_path)}}
    {% if tergabung is defined %}
        {% if tergabung.role == 1 %}
            <button data-toggle='modal' data-target='#deleteModal'>Hapus Foto</button>
            <button data-toggle='modal' data-target='#changeModal'>Ubah Foto</button>

            <div class="modal" id="deleteModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hapus Foto Komunitas</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id='form-delete' action='/komunitas/deletephoto' method='post'>
                                <input type="hidden" name="id_komunitas" value={{item.ko.id}}>
                                <input type="submit" value="Hapus" name='deletephoto'>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="changeModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah Foto Komunitas</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id='form-delete' action='/komunitas/changephoto' method='post' enctype="multipart/form-data">
                                <input type="hidden" name="id_komunitas" value={{item.ko.id}}>
                                <input type="file" name="photo" id="photo">
                                <input type="submit" value="Ubah" name='changephoto'>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        {% endif %}
    {% endif %}
    <div>
        <table>
            <tr>
                <td>
                    Kategori
                </td>
                <td>
                    {{item.nama_kategori}}
                </td>
            </tr>
            <tr>
                <td>
                    Pemilik
                </td>
                <td>
                    {{item.ko.owner}}
                </td>
            </tr>
            <tr>
                <td>
                    Alamat
                </td>
                <td>
                    {{item.ko.alamat}}
                </td>
            </tr>
            <tr>
                <td>
                    Deskripsi
                </td>
                <td>
                    {{item.ko.deskripsi}}
                </td>
            </tr>
        </table>
    </div>
    {% if tergabung is null %}
        <form action="/komunitas/gabung" method="POST">
            <input type="hidden" name="id_komunitas" value={{item.ko.id}}>
            <input class='btn btn-primary' type="submit" value="Gabung" name="gabung">
        </form>
    {% elseif tergabung.verified == 1 %}
        <button class='btn btn-secondary' disabled>Tergabung</button>
        <a href="{{ url("komunitas/anggota/"~item.ko.id)}}">
            <button class="btn btn-primary">Lihat Anggota</button>
        </a>
        {% if tergabung.role == 1 %}
        <a href="{{ url("komunitas/edit/"~item.ko.id)}}">
            <button class="btn btn-info">Sunting Detail</button>
        </a>
        <a href="{{ url("pagelaran/buat/"~item.ko.id)}}">
            <button class="btn btn-info">Buat Pagelaran</button>
        </a>
        {% endif %}
    {% else %}
        <button class='btn btn-secondary' disabled>Menunggu Konfirmasi</button>
    {% endif %}
    <a href="{{ url("pagelaran/list/"~item.ko.id)}}">
        <button class="btn btn-primary">Lihat Pagelaran</button>
    </a>

    {% if this.session.has('auth') and tergabung is defined and tergabung.role == 1%}
    <div class="container-fluid">
        <h3>Permintaan Bergabung</h3>
        <div>
            <ul>
                {% for item in permintaan %}
                <li class='list-group-item'>
                    <span>
                        <form action="{{url('komunitas/verifikasi')}}" method="POST">
                        <a href="/user/{{item.id_user}}">{{item.id_user}}</a> ingin bergabung.
                        <input type="hidden" name="id_user" value={{ item.id_user }}>
                        <input type="hidden" name="id_komunitas" value={{ item.id_komunitas }}>
                        <input class='btn btn-success' type="submit" value="Terima" name="terima">
                        <input class='btn btn-danger' type="submit" value="Tolak" name="tolak">
                        </form>
                    </span>
                </li>
                {% endfor %}
    
            </ul>
        </div>
        {% endif %}
        
    </div>
{% endblock %}