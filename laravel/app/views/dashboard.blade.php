@extends('layouts/adminMaster')

@section('content')

<div class="resize"align="center">
        <h1 class="signin-h1"> Dashboard </h1>
        

    <?php if (!empty($errorLogin)) { ?> 
            <div class="alert alert-warning clearfix ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div class="errorLog">
                <?php echo $errorLogin; ?>
                </div>
    <?php } ?>

        </div>



    <div class = 'form-signin form-validate'>
                
        <h4> You have {{$info['unread']}} new messages in your INBOX </h4>
         <div class="form-group">
            <label>Unread</label>
            <div>{{$info['unread']}} </div>
        </div>  
        
        <div class="form-group">
            <label>Inbox</label>
            <div>{{$info['inbox']}} </div>
        </div>
        
        <div class="form-group">
            <label>Sent</label>
            <div>{{$info['sent']}} </div>
        </div>             
        
    </div>
</div>
    

@stop
         
                
                    