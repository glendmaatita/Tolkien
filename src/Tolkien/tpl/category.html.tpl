{% extends "layout.html.tpl" %}

{% block title %}{{ category.name }}{% endblock %}
{% block content %}
	<div class="col-md-9">
		{% for post in category.posts %}
		  <h3><a href="{{ post.url }}">{{ post.title }}</a></h3>
		  <p>by {{ post.author.name }} on {{ post.publishDate}} </p>
		  {% if post.excerpt is null %}
		  	{{ post.body | raw }}
		  {% else %}
		  	{{ post.excerpt| raw }}
		  	<p><a href="{{ post.url }}">Read More</a></p>
		  {% endif %}
		  <hr>
	  {% endfor %}
	</div>
	{% include "sidebar.html.tpl" %}
{% endblock %}