{% extends "layout.html.tpl" %}

{% block title %}{{ siteCategory.name }}{% endblock %}
{% block content %}
	<div class="col-md-9">
		{% for post in siteCategory.posts %}
		  <h3><a href="{{ post.url }}">{{ post.title }}</a></h3>
		  <p>by {{ post.author.name }} on {{ post.publishDate}} </p>
		  {{ post.body | raw }}
	  {% endfor %}
	</div>
	{% include "sidebar.html.tpl" %}
{% endblock %}