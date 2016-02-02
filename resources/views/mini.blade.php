<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Mcdonald&#39;s Crew Development Training System</title>

        <!-- Bootstrap -->
        <link href="{{ asset('app.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

        @yield('styles')
    </head>
    <body>

        @yield('content')


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('app.min.js') }}"></script>
        <!-- Google Fonts embed code -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->


        @yield('scripts')

    </body>
</html>
