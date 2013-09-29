{% extends "layout.html.tpl" %}

{% block title %}{{ site.title }}{% endblock %}
{% block content %}
	<div class="col-md-9">
		{% for post in pagination.posts %}
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
	  <hr>
	  {% if pagination.previousPage is defined %}
		  <div class="col-md-3">
		  	<a href="{{ pagination.previousPage.url }}"><< Sebelumnya</a>
		  </div>
		 {% endif %}
		 {% if pagination.previousPage is defined %}
		  <div class="col-md-3 pull-right">
		  	<a href="{{ pagination.nextPage.url }}">Berikutnya >></a>
		  </div>
	  {% endif %}
	</div>
	{% include "sidebar.html.tpl" %}
{% endblock %}

