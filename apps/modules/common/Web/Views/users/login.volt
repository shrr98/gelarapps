{% extends "layouts/base.volt" %}

{% block title %}Masuk{% endblock %}

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
    <div class="flashdiv">
      {{ this.flash.output() }}
    </div>
      {{ form.startForm() }}
            {{ form.rendering('username') }}
            {{ form.rendering('password') }}
            <div>
                {{ form.rendering('remember') }}
                <label for="remember">Ingat saya</label>
            </div>
            {{ form.rendering('Masuk')}}
            
      {{ form.endForm() }}
  
      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Lupa Password?</a>
      </div>
  
    </div>

</div>

{% endblock %}  