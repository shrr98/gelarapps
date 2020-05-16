{% extends "layouts/base.volt" %}

{% block title %}Beranda{% endblock %}


{% block content %}

{{ flash.error("ERROR!") }}
Halaman tidak ditemukan! Kembali ke <a href="/">Halaman awal</a>.

{% endblock %}