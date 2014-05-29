<header id="top">
    <div class="topHeaderLine">
    </div>
    <div class="topHeader clearfix">
       <h1>
            <img src="{{ URL::to('img/logos.jpg') }}" alt="Quiet loves Messages" title="Quiet"/>
       </h1>
        
       @if (Auth::check())
        <div class="welcome-message">
            Welcome, {{Auth::user()->username}}
            <div class="li2" role="presentation"><a  tabindex="-1" href="{{ url('users/logout') }}">LOGOUT</a></div>
        </div>
       @endif
    </div>
</header>

