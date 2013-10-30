{% extends "layout.html.tpl" %}

{% block title %}{{ post.title }}{% endblock %}
{% block content %}
	<div class="col-md-9">
	  <h3>{{ post.title }}</h3>
	  <p>Categories
	  	<em>
	  	{% for category in site.categories %}
			  <a href="{{ category.url }}">{{ category.name | capitalize }}</a> 
		  {% endfor %}
		  </em>
		  on {{ post.publishDate}}
	  </p>
	  {{ post.body | raw }} 

	  <p>by {{ post.author.name }} | Mention me on {{ post.author.twitter }}</p>
	</div>	

	{% include "sidebar.html.tpl" %}
{% endblock %}