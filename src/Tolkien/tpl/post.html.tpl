{% extends "layout.html.tpl" %}

{% block title %}{{ post.title }}{% endblock %}
{% block content %}
	<div class="col-md-9">
	  <h3>{{ post.title }}</h3>
	  <p>Categories
	  	<em>
	  	{% for siteCategory in site.siteCategories %}
			  <a href="{{ siteCategory.url }}">{{ siteCategory.name | capitalize }}</a> 
		  {% endfor %}
		  </em>
		  on {{ post.publishDate}}
	  </p>
	  {{ post.body | raw }} 

	  <p>by {{ post.author.name }}</p>
  	<p>Contact me on {{ post.author.twitter }} | {{ post.author.github }}</p>
	</div>	

	{% include "sidebar.html.tpl" %}
{% endblock %}