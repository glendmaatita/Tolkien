{% extends "layout.html.tpl" %}

{% block title %}Home{% endblock %}

{% block content %}
	<div class="main">
		{% for posts in post %}
			<h2>{{ post.title }}</h2>
				<p class="meta">{{ page.date }} by {{ post.author.name }}</p>
				<div class="post">
				{{ post.body | raw }}
			</div>
		{% endfor %}
	</div>
{% endblock %}