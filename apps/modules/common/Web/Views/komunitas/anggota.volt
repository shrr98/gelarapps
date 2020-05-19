{% extends "layouts/base.volt" %}

{% block title %}Anggota{% endblock %}

{% block content %}
    <h1 align="center">Anggota Komunitas</h1>
    <div>
        <table class='table'>
            {% for item in anggota %}
                <tr>
                    <td>
                        <a href="{{url('profil/'~item.id_user)}}">{{item.id_user}}</a>
                    </td>
                    <td>
                        {{ date('d-M-Y', strtotime(item.tgl_bergabung)) }}
                    </td>
                    <td>
                        {% if item.role ==1 %}
                            admin
                        {% else %}
                            anggota
                            {% if role == 1 %}
                            <td>
                                <button class="jadiadmin-btn" id={{item.id_user}} data-toggle='modal' data-target='#adminModal'>Jadikan Admin</button>
                                <button class="hapusmember-btn" id={{item.id_user}} data-toggle='modal' data-target='#deleteModal'>Keluarkan</button>
                            </td>
                            {% endif %}
                        {%endif%}
                    </td>
                </tr>
            {% endfor %}
            </table>
    </div>

    {% if role==1 %}
        <div class="modal" id="deleteModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Keluarkan Anggota</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin mengeluarkan <a href="#" id="id_member"></a>?</p>
                    </div>
                    <div class="modal-footer">
                        <form id='form-delete' action='/komunitas/deletemember' method='post'>
                            <input type="hidden" name="id_komunitas" value={{id_komunitas}}>
                            <input type="hidden" name="id_member" value="" id="input_id_member">
                            <input type="submit" value="Keluarkan" name='deletemember'>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="adminModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Jadikan Admin</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menjadikan <a href="#" id="id_member_admin"></a> sebagai admin?</p>
                    </div>
                    <div class="modal-footer">
                        <form id='form-delete' action='/komunitas/setadmin' method='post'>
                            <input type="hidden" name="id_komunitas" value={{id_komunitas}}>
                            <input type="hidden" name="id_member" value="" id="input_id_member_admin">
                            <input type="submit" value="Jadikan Admin" name='setadmin'>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    {% endif %}
{% endblock %}

{% block footer %}
<script src="{{ url("js/anggota.js")}}"></script>
{% endblock %}