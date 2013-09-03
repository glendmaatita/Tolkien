<div class="header">
	<h1 class="title"><a href="/">{{ site.name }}</a></h1>
	{% for p in pages %}
		<a class="extra" href="{{ p.url }}">{{ p.title }}</a>
	{% endfor %}
</div>