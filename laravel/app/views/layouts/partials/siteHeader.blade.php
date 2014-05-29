<header id="top">
    <div class="topHeaderSight">
        <h1 class="headerTextFirst">AROBS ACADEMY</h1><br><br><br>
     
        <div id="login">
            <?php if(Auth::check()){ ?>
             <a href="{{url('users/logout')}}" class="btn btn-primary btn-lg active"  role="button">LogOut Admin</a>  
            <?php }else{ ?>
            <a href="{{url('users/login')}}" class="btn btn-primary btn-lg active"  role="button">LogIn Admin</a>
            <?php }?>
        </div>
        <h3 class="headerTextSecond">There are passionate people at Arobs.</h3>
        <h3 class="headerTextSecond">You fit in naturally.</h3>
    </div>
    <div class="topMenu" align="center">
        @include('layouts/partials/frontmenu') 
    </div>
</header>