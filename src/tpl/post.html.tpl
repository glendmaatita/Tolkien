{% extends "layout.html.tpl" %}

{% block title %}{{ post.title }}{% endblock %}
{% block content %}
	<div class="col-md-9">
	  <h3>{{ post. title }}</h3>
	  <p>by {{ post.author.name }} on {{ post.publishDate }}</p>
	  {{ post.body | raw }}  
	</div>

	{% include "sidebar.html.tpl" %}
{% endblock %}