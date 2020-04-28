{% extends "layouts/base.volt" %}

{% block title %}Komunitas : {{item.ko.nama_komunitas}}{% endblock %}

{% block content %}
    <h1>Komunitas > {{item.ko.nama_komunitas}}</h1>
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
    {% else %}
        <button class='btn btn-secondary' disabled>Tergabung</button>
    {% endif %}
{% endblock %}