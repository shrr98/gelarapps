{% extends "layouts/base.volt" %}

{% block title %}Daftar{% endblock %}

{% block additional_header %}
<link rel="stylesheet" href="css/form.css">
{% endblock %}

{% block content %}
<div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
  
      <!-- Icon -->
      <div class="fadeIn first">
        <img src="assets/logo.png" id="icon" alt="User Icon" />
      </div>

      <div class="notif">
        {{ this.flash.output() }}
      </div>
      {% if form is not null %}
        {{ form.startForm() }}
          {{ form.rendering('nama') }}
          {% if errmsg is defined and errmsg['nama'] is defined %}
            {{ flash.error(errmsg['nama']) }}
          {% endif %}

          {{ form.rendering('username') }}
          {% if errmsg is defined and errmsg['username'] is defined %}
            {{ flash.error(errmsg['username']) }}
          {% endif %}

          {{ form.rendering('email') }}
          {% if errmsg is defined and errmsg['email'] is defined %}
            {{ flash.error(errmsg['email']) }}
          {% endif %}

          {{ form.rendering('password') }}
          {% if errmsg is defined and errmsg['password'] is defined %}
            {{ flash.error(errmsg['password']) }}
          {% endif %}

          {{ form.rendering('Daftar') }}
        {{ form.endForm() }}
      {% endif %}
   
    </div>

</div>

{% endblock %}