<div class="col-md-3">
  <div class="well">
    <ul class="nav">
    	{% for category in site.categories %}
      	<li><a href="{{ category.url }}">{{ category.name }}</a></li>
      {% endfor %}
    </ul>
  </div>
</div>