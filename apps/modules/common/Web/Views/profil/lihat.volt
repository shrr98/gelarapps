{% extends "layouts/base.volt" %}

{% block title %}{{profil.nama}}{% endblock %}

{% block content %}
    <h1>{{profil.username}}</h1>
    {% if profil.photo %}
        {{ image('data:image/png;base64,'~profil.photo, "width" : "30%", 'alt' : 'profil picture')}}
    {% else %}
        {{ image('assets/default_pp.png', "width" : "30%", 'alt' : 'profil picture')}}
    {% endif %}

    <p>
        {{ '@'~profil.username }}
    </p>
    <p>
        {{ profil.email }}
    </p>
    <p>
        {{ profil.status }}
    </p>
{% endblock %}