<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css') }}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="container">
            {{ get_content() }}
        </div>
        {{ javascript_include('https://code.jquery.com/jquery.js') }}
        {{ javascript_include('//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js') }}
    </body>
</html>