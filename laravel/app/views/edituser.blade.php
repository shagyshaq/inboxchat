@extends('layouts/adminMaster')

@section('content')
   
<div>
    <h1 class="signin-h1"> be Quiet </h1>
    <?php $user = Session::get('user') ;
          $validate_messages = Session::get('validate_messages') ;
          //var_dump($validate_messages);
            ?>
    {{ Form::open(['url' => 'users/edit', 'method' => 'post', 'class' => 'form-signin form-validate', 'id' => 'create-user-details']) }}
    <h2>{{isset($user) && isset($user->id) ? 'Edit Your Details' : 'Register User'}}</h2>
    <div class="form-group">

        @if(isset($validate_messages) && $validate_messages->has('username')) 
        <div class="form-group has-error" data-toggle="popover" >
            <label class="control-label" for="inputError1">
                {{$validate_messages->first('username')}}
            </label>
        </div>
        @endif

        {{Form::label('username', 'Username')}} 
        {{Form::text('username', isset($user) ? $user->username : '', array('class'  => 'form-control'))}}

    </div>

    <div class="form-group">

        @if (isset($validate_messages) && $validate_messages->has('email')) 
        <div class="form-group has-error" data-toggle="popover" >
            <label class="control-label" for="inputError1">
                {{$validate_messages->first('email')}}
            </label>
        </div>
        @endif		

        {{Form::label('email', 'Email')}} 
        {{Form::text('email',isset($user) ? $user->email : '', array('class'  => 'form-control'))}}
    </div>

    <div class="form-group">
        @if (!isset($user) || !isset($user->id))
            @if (isset($validate_messages) && $validate_messages->has('password')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('password')}}
                </label>
            </div>
            @endif		
        {{Form::label('password', 'Password')}} 
        {{ Form::password('password', array('class'  => 'form-control')) }}
        @endif

    </div>

    <div class="form-group">
        @if (!isset($user) || !isset($user->id))
            @if (isset($validate_messages) && $validate_messages->has('password_confirmation')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('password_confirmation')}}
                </label>
            </div>
            @endif		
        {{Form::label('confirmpassword', 'Confirm Password')}} 
        {{ Form::password('confirmPassword', array('class'  => 'form-control')) }}
        @endif

    </div>

    <div class="form-group">
        @if (!isset($user) || !isset($user->id))
            @if (isset($validate_messages) && $validate_messages->has('birthday')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('birthday')}}
                </label>
            </div>
            @endif		
        {{Form::label('birthday', 'BirthDay')}} 
        {{Form::text('birthday',isset($user) ? $user->birthday : '', array('class'  => 'form-control'))}}
        @endif

    </div>

    @if (isset($user))
        {{Form::hidden('id', $user->id)}}
        {{Form::hidden('active', $user->active)}}
    @endif
    {{ Form::submit(isset($user) && isset($user->id) ? 'Update' : 'Create', array('class'  => 'btn btn-primary')) }} 
    {{ HTML::linkAction('UsersController@listUsers', 'Cancel', array('class'=>'btn btn-primary')) }} 
    {{ Form::close() }}	
    
</div>

@stop
		
 

