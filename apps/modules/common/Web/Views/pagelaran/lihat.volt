{% extends "layouts/base.volt" %}

{% block title %}Pagelaran : {{item.pa.judul}}{% endblock %}

{% block content %}
    <h1 align="center"><a href="{{url('pagelaran')}}">Pagelaran</a> > {{item.pa.judul}}</h1>
    <div class='container-fluid'>
        {{ image('data/pagelaran/'~item.pa.photo_path, "width" : "50%")}}
        <table>
            <tr>
                <td>
                    Judul: 
                </td>
                <td>
                    {{item.pa.judul}}
                </td>
            </tr>
            <tr>
                <td>
                    Kategori: 
                </td>
                <td>
                    {{item.nama_kategori}}
                </td>
            </tr>
            <tr>
                <td>
                    Komunitas: 
                </td>
                <td>
                    {{item.nama_komunitas}}
                </td>
            </tr>
            <tr>
                <td>
                    Author: 
                </td>
                <td>
                    {{item.pa.creator}}
                </td>
            </tr>
            <tr>
                <td>
                    Tempat: 
                </td>
                <td>
                    {{item.pa.tempat}}
                </td>
            </tr>
            <tr>
                <td>
                    Waktu: 
                </td>
                <td>
                    {{ date('d-M-Y H:i', strtotime(item.pa.waktu_mulai)) ~ ' s/d ' ~ date('d-M-Y H:i', strtotime(item.pa.waktu_selesai))}} 
                </td>
            </tr>
            <tr>
                <td>
                    Deskripsi: 
                </td>
                <td>
                    <br/>
                    {{item.pa.deskripsi}}
                </td>
            </tr>
        </table>

        {% if session.has('auth') and item.pa.creator == session.get('auth')['username'] %}
            <a href="{{url('/pagelaran/edit/'~item.pa.id)}}"><button class="btn btn-primary">Sunting</button></a>
            <button data-toggle='modal' data-target='#deleteModal'>Hapus</button>
            
            <div class="modal" id="deleteModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hapus Pagelaran</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus pagelaran ini?</p>
                        </div>
                        <div class="modal-footer">
                            <form id='form-delete' action='/pagelaran/hapus' method='POST'>
                                <input type="hidden" name="id_pagelaran" value={{item.pa.id}}>
                                <input type="submit" value="Hapus" name='hapus'>
                            </form>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        {% endif %}
    </div>
{% endblock %}