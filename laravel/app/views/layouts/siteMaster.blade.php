<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Welcome to Arobs</title>
        <link href="{{URL::to('css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{URL::to('css/custom/site.main.css')}}" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
        @include('layouts/partials/siteHeader')
        
        <div class="container">
           
                <div class="content">
                    @yield('content')
                
                </div>
            
        </div
        
        @include('layouts/partials/siteFooter')
        
        <script>
            var baseUrl = "{{ URL::to('') }}";
        </script>
        
        <script src="{{ URL::to('js/jquery.js') }}"></script>
        <script src="{{ URL::to('js/bootstrap.js') }}"></script>
        <script src="{{ URL::to('js/custom/site.main.js') }}"></script>
        
        @yield('additionalScripts')
   
    </body>
</html>