<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Type like a maniac</title>
        
        <!-- Bootstrap -->
        <link href="{{ URL::to('css/bootstrap.css') }}" rel="stylesheet">
        <!-- custom css -->
        <link href="{{ URL::to('css/custom/admin.main.css') }}" rel="stylesheet">
        <link href="{{ URL::to('css/plugins/multiple-select.css') }}" rel="stylesheet">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
        @include('layouts/partials/adminHeader')     
        
         <div class="container">
             @if (Auth::check())
                
             <div class="meniu" id="rotund">
                 <h1 class="signin-h1"> QUIET </h1><br>
                 <div>
                     <ul>

                         <li class="li" role="presentation"><a align="center" tabindex="-1" href="{{ url('messages/inbox') }}">Inbox</a></li>
                         <li class="li" role="presentation"><a align="center" tabindex="-1" href="{{ url('messages/sent') }}">Sent</a></li>
                         <li class="li"role="presentation"><a tabindex="-1" href="{{ url('messages/create') }}">Create Message</a></li>
                         <li class="li "role="presentation"><a  tabindex="-1" href="{{ url('menus/list') }}">User List</a></li>
                        
                         <li class="li" role="presentation"><a  tabindex="-1" href="{{ url('messages/count') }}">Dashboard</a></li>
                         
                         @yield('users')
                     </ul>
                 </div>

             </div>
             <div class="content">

                 @yield('content')

             </div>


             @else  @yield('content')
             @endif
         </div> 
        
         @include('layouts/partials/siteFooter')
        
        <script>
            var baseUrl = "{{ URL::to('') }}";
        </script>
        <script src="{{ URL::to('js/jquery.js') }}"></script>
        <script src="{{ URL::to('js/bootstrap.js') }}"></script>
        <script src="{{ URL::to('js/plugins/jqueryvalidation/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::to('js/plugins/jquery.multiple.select.js') }}"></script>
        <script src="{{ URL::to('js/custom/admin.main.js') }}"></script>
        
        
        @yield('additionalScripts')
    
</html>
