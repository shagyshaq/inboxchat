<!-- Site footer -->
 
<!--<div class="footer navbar-fixed-bottom" align ="center"> -->
<div class="footer " align ="center" id ="footer">
    
    <p>&copy;Copyright 2014 All rights reserved.</p>
    
    <link href="{{URL::to('css/custom/site.main.css')}}" rel="stylesheet">
    
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
