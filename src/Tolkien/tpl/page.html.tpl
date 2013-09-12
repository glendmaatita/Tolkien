{% extends "layout.html.tpl" %}

{% block title %}{{ page.title }}{% endblock %}
{% block content %}
	<div class="col-md-9">
	  <h3>{{ page. title }}</h3>
	  {{ page.body | raw }}  
	</div>
{% endblock %}