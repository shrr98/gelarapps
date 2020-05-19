{% extends "layouts/base.volt" %}

{% block title %}Kegiatan : {{item.judul}}{% endblock %}

{% block content %}
    <h1 align="center"><a href="{{url('kegiatan/list/'~komunitas.id)}}">Kegiatan</a> > {{item.judul}}</h1>
    <div class='container-fluid'>
        <table>
            <tr>
                <td>
                    Judul: 
                </td>
                <td>
                    {{item.judul}}
                </td>
            </tr>
            <tr>
                <td>
                    Komunitas: 
                </td>
                <td>
                    {{komunitas.nama_komunitas}}
                </td>
            </tr>
            <tr>
                <td>
                    Author: 
                </td>
                <td>
                    {{item.creator}}
                </td>
            </tr>
            <tr>
                <td>
                    Tempat: 
                </td>
                <td>
                    {{item.tempat}}
                </td>
            </tr>
            <tr>
                <td>
                    Waktu: 
                </td>
                <td>
                    {{ date('d-M-Y H:i', strtotime(item.waktu_mulai)) ~ ' s/d ' ~ date('d-M-Y H:i', strtotime(item.waktu_selesai))}} 
                </td>
            </tr>
            <tr>
                <td>
                    Deskripsi: 
                </td>
                <td>
                    <br/>
                    {{item.deskripsi}}
                </td>
            </tr>
        </table>

        {% if session.has('auth') and item.creator == session.get('auth')['username'] %}
            <a href="{{url('/kegiatan/edit/'~item.id)}}"><button class="btn btn-primary">Sunting</button></a>
            <button data-toggle='modal' data-target='#deleteModal'>Hapus</button>
            
            <div class="modal" id="deleteModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hapus kegiatan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus kegiatan ini?</p>
                        </div>
                        <div class="modal-footer">
                            <form id='form-delete' action='/kegiatan/hapus' method='POST'>
                                <input type="hidden" name="id_kegiatan" value={{item.id}}>
                                <input type="submit" value="Hapus" name='hapus'>
                            </form>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        {% endif %}
    </div>

    <div class='komentar'>
        <h4>Komentar</h4>
        {% for it in komentar %}
        <div>
            <h4>
                <a href="{{ '/profil/' ~ it.author }}">
                    {{ it.author }}
                </a>
            </h4>
            <p>
                {{ date('d-M-Y H:i:s', strtotime(it.waktu)) }}
            </p>
            <div>
                {{ it.isi }}
            </div>
        </div>
        {% endfor %}
        <div>
            <form id='komenform' action="/kegiatan/komentar" method="POST">
                <input type="hidden" name="id_kegiatan" value={{ item.id }}>
                <textarea form='komenform' id="story" name="isi"
                        rows="5" cols="50" placeholder="Komentar..."></textarea>
                <input type="submit" value="Kirim">
            </form>
        </div>
    </div>
{% endblock %}