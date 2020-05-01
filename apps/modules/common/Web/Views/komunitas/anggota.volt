{% extends "layouts/base.volt" %}

{% block title %}Anggota{% endblock %}

{% block content %}
    <h1>Anggota Komunitas</h1>
    <div>
        <table class='table'>
            {% for item in anggota %}
                <tr>
                    <td>
                        <a href="{{url('komunitas/lihat/'~item.id_user)}}">{{item.id_user}}</a>
                    </td>
                    <td>
                        {{ date('d-M-Y', strtotime(item.tgl_bergabung)) }}
                    </td>
                    <td>
                        {% if item.role ==1 %}
                            admin
                        {% else %}
                            anggota
                        {%endif%}
                    </td>
                </tr>
            {% endfor %}
            </table>
    </div>
{% endblock %}