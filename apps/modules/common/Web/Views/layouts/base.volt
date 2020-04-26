<!DOCTYPE html>
<html>
	<head>
        {% include 'layouts/header.volt' %}
        {% block additional_header %}{% endblock %}
		<title>GelarApps - {% block title %}{% endblock %}</title>
	</head>
	<body>
        
        {% if session.has('auth') %}
        {% include "layouts/nav_session.volt" %}
        {% else %}
        {% include "layouts/nav_default.volt" %}
        {% endif %}

		{% block content %}{% endblock %}

		
		</body>
</html>