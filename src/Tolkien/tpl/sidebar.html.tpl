<div class="col-md-3">
  <div class="well">
    <ul class="nav">
    	<li>Categories</li>
    	{% for category in site.categories %}
      	<li><a href="{{ category.url }}">{{ category.name | capitalize }}</a></li>
      {% endfor %}
    </ul>
  </div>
</div>