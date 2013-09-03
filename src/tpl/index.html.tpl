{% extends "layout.html.tpl" %}

{% block title %}Home{% endblock %}

{% block content %}
	<div class="main">
		{% for posts in post %}
			<h2>{{ post.title }}</h2>
				<p class="meta">{{ page.date }}</p>\
				<div class="post">
				{{ post.body }}
			</div>
		{% endfor %}
	</div>
{% endblock %}