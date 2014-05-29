@extends('layouts/adminMaster')



@section('content')

<?php if (Auth::check()) {
    
} else { ?>
    <div class="resize"align="center">
        <h1 class="signin-h1"> Welcome to beQuiet </h1>
        <?php $errorLogin = Session::get('messageLogin'); ?>

    <?php if (!empty($errorLogin)) { ?> 
            <div class="alert alert-warning clearfix ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div class="errorLog">
                <?php echo $errorLogin; ?>
                </div>
    <?php } ?>

        </div>



    {{ Form::open(['url' => 'users/signin', 'method' => 'post', 'class' => 'form-signin form-validate', 'id' => 'validate-login']) }}
        <h2>Login</h2>
        
        <div class="form-group">
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username', Input::old('username'), array('class'  => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', array('class'  => 'form-control')) }}
        </div>
        
        {{ Form::submit('Login', array('class'  => 'btn btn-primary')) }}
    </div>
    {{ Form::close() }}
    
<?php } ?>
@stop