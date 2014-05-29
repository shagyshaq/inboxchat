@extends('layouts/adminMaster')

@section('content')
   
<div>
    <h1 class="signin-h1"> be Quiet </h1>
    
    <h2>{{isset($pageh2) ? $pageh2 . ' Message' : 'Message not sent yet'}} </h2>
    
    <div id = 'form-simple-content'>
        
        <div class="form-group">    
            <div> From: </div>
            <div> {{ isset($toemail) ? 
                            $toemail : 
                            ''}} 
            </div>
        </div>

        <div class="form-group">        
            <div> {{ isset($inboxmessage) && isset($inboxmessage->created_at) ? 
                            $inboxmessage->created_at : 
                            ''}} 
            </div>
        </div>

        <div class="form-group">
            <div> Subject: </div>
            <div> {{ isset($inboxmessage) && isset($inboxmessage->subject) ? 
                            $inboxmessage->subject : 
                            ''}} 
            </div>
        </div>

        <div class="form-group">
            <div> Content: </div>
            <div> {{ isset($inboxmessage) && isset($inboxmessage->content) ? 
                            $inboxmessage->content : 
                            ''}} 
            </div>
        </div>
        
    </div>    
    
    <button id = "click-toolge-forward"> Forward to </button>
    <button id = "click-toolge-reply"> Reply </button>
    <button id = "click-toolge-edit"> Forward </button>
    
     <div id = "form-simple-forward">
        {{ Form::open(['url' => 'messages/forward', 'method' => 'post', 'class' => 'form-signin form-validate', 'id' => 'create-user-details']) }}
            @if (isset($inboxmessage) && isset($inboxmessage->id_message))
                {{Form::hidden('id_message', $inboxmessage->id_message)}}         
            @endif
            <label> To: </label>
            {{ Form::text('toemail', Input::old('username'), array('class'  => 'form-control', 'placeholder' => 'Insert Email')) }}
            {{ Form::submit('Forward', array('class'  => 'btn btn-primary')) }}             
        {{ Form::close() }}	
     </div>
    
    <div id = "form-simple-reply">
        {{ Form::open(['url' => 'messages/reply', 'method' => 'post', 'files'=>true, 'class' => 'resize form-signin form-validate',  'enctype' => 'multipart/form-data', 'id'=>'validate-page']) }}
            
            @if (isset($inboxmessage) && isset($inboxmessage->id_message))
                {{Form::hidden('sender_id', Auth::user()->id)}}
                @if ($inboxmessage->sender_id == Auth::user()->id) 
                    {{Form::hidden('receiver_id', $inboxmessage->receiver_id)}}
                @else 
                    {{Form::hidden('receiver_id', $inboxmessage->sender_id)}}
                @endif
                {{Form::hidden('subject', $inboxmessage->subject)}}
            @endif
            
            <label for='full_text'>Content:</label>
            {{Form::textarea('contentmessage',Input::old('contentmessage'), array('placeholder'=>'Content','class'  => 'form-control', 'cols' => '100'))}}
            
            {{ Form::submit('Reply', array('class'  => 'btn btn-primary')) }}             
        {{ Form::close() }}	
     </div>
    
    <div id = "form-simple-edit">
        {{ Form::open(['url' => 'messages/send', 'method' => 'post', 'files'=>true, 'class' => 'resize form-signin form-validate',  'enctype' => 'multipart/form-data', 'id'=>'validate-page']) }}      

        <div class="form-group">
            @if (isset($validate_messages) && $validate_messages->has('toemail')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('toemail')}}
                </label>
            </div>
            @endif      

            {{Form::label('toemail', 'To:')}} 
            {{Form::text('toemail',Input::old('toemail', isset($toemail) ? $toemail : ''), array('placeholder'=>'Email','class'  => 'form-control'),isset($post) ? $post->title : '')}}<br>
        </div>

        <div class="form-group">
            @if (isset($validate_messages) && $validate_messages->has('subject')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('subject')}}
                </label>
            </div>
            @endif	

            {{Form::label('subject', 'Subject:')}} 
            {{Form::text('subject',Input::old('subject', isset($inboxmessage) ? $inboxmessage->subject : ''), array('placeholder'=>'Subject','class'  => 'form-control'))}}<br>
        </div>

        <div class="form-group">
            @if (isset($validate_messages) && $validate_messages->has('contentmessage')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('contentmessage')}}
                </label>
            </div>
            @endif

            <!--            {{Form::label('full_text', 'Full_text:')}} -->
            <label for='full_text'>Content:</label>
            {{Form::textarea('contentmessage',Input::old('contentmessage', isset($inboxmessage) ? $inboxmessage->content : ''), array('placeholder'=>'Content','class'  => 'form-control', 'cols' => '100'),isset($post) ? $post->full_text : '')}}
        </div>

        <div class="form-group">
            @if (isset($post->image))
            <div class="form-group">
                {{ HTML::image( $post->image, $alt="DRCSports", $attributes = array()) }}
            </div>
            @endif

            {{Form::label('image', 'Image:', array('class' => 'form-group'))}} 
            {{Form::file('image', array('class' => 'form-group'))}}
            </br>


            @if (isset($post))
            {{Form::hidden('id', $post->id)}}
            @endif

            <?php echo Form::submit(isset($post) ? 'Edit' : 'Create', array('class' => 'btn btn-primary btn-lg')); ?>

        </div>
        {{ Form::close() }}
        
     </div>
    
    
</div>

@stop
		
 

