{% extends "layout.html.tpl" %}

{% block title %}{{ site.title }}{% endblock %}
{% block content %}
	<div class="col-md-9">
		{% for post in site.posts %}
		  <h3><a href="{{ post.url }}">{{ post.title }}</a></h3>
		  <p>by {{ post.author.name }} on {{ post.publishDate}} </p>
		  {{ post.body | raw }}
	  {% endfor %}
	</div>
	{% include "sidebar.html.tpl" %}
{% endblock %}