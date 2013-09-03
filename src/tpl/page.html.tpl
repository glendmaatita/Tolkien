{% extends "layout.html.tpl" %}

{% block title %}{{ page.title }}{% endblock %}

{% block content %}
	<div class="main">
		<h2>{{ page.title }}</h2>
		<div class="page">
		{{ page.body | raw }}
		</div>
	</div>
{% endblock %}