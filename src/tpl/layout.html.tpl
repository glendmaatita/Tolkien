<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{% block title %}{% endblock %}</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="{{ site.url }}css/syntax.css">
    <link rel="stylesheet" href="{{ site.url }}css/main.css">
  </head>
  <body>
  	<div class="container">
  		<div class="site">
  			{% include "header.html.tpl" %}

        {% include "sidebar.html.tpl" %}        

  			{% block content %}{% endblock %}
  		</div>
  	</div> 
  </body>
</html>