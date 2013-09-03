{% extends "layout.html.tpl" %}

{% block title %}{{ post.title }}{% endblock %}

{% block content %}
	<div class="main">
		<h2>{{ post.title }}</h2>
		<p class="meta">{{ post.date }}</p>
		<div class="post">
		{{ post.body | raw }}
		</div>
	</div>
	<div class="footer">
		<div class="contact">
			<p>
				{{ post.author.name }}<br />
				{{ post.author.signature }}<br />
				{{ post.author.email }}
			</p>
		</div>
		<div class="contact">
			<p>
				<a href="http://facebook.com/{{ post.author.facebook }}/">Facebook: {{ post.author.facebook }}</a><br />
				<a href="http://twitter.com/{{ post.author.twitter }}/">Twitter: {{ post.author.twitter }} </a><br />
				<a href="http://github.com/{{ post.author.github }}/">Github: {{ post.author.github }}</a><br />
			</p>
		</div>
	</div>
{% endblock %}