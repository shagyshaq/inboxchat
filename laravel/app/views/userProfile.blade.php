@extends('layouts/adminMaster')

@section('content')

<div class="resize"align="center">
        <h1 class="signin-h1"> Profile Details </h1>
        

    <?php if (!empty($errorLogin)) { ?> 
            <div class="alert alert-warning clearfix ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div class="errorLog">
                <?php echo $errorLogin; ?>
                </div>
    <?php } ?>

        </div>
        
    <div class = 'form-signin form-validate'>
              
         <div class="form-group">
            <label> Username: </label>
            <div>{{$userProfile['username']}} </div>
        </div>  
        
        <div class="form-group">
            <label> Email: </label>
            <div>{{$userProfile['email']}} </div>
        </div>
        
        <div class="form-group">
            <label> Birthday: </label>
            <div>{{$userProfile['birthday']}} </div>
        </div>             
        
    </div>
        
</div>
    

@stop
         
                
                    