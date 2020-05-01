{% extends "layouts/base.volt" %}

{% block title %}Beranda{% endblock %}


{% block content %}

{{ flash.error("ERROR!") }}
<a href="{{url('login')}}">Masuk</a> dahulu sebelum mengakses halaman ini.

{% endblock %}