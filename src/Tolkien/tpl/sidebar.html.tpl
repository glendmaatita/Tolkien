<div class="col-md-3">
  <div class="well">
    <ul class="nav">
    	{% for siteCategory in site.siteCategories %}
      	<li><a href="{{ siteCategory.url }}">{{ siteCategory.name | capitalize }}</a></li>
      {% endfor %}
    </ul>
  </div>
</div>