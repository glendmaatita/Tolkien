<!DOCTYPE html>
<html>
  <head>
    <title>{% block title %}{% endblock %}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ site.url }}/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    {% include "header.html.tpl" %}

    <div class="container">
      <div class="row">     
        {% block content %}{% endblock %}
      </div>
      <hr>
      <footer>
        <p>Tolkien by Glend Maatita</p>
      </footer>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
