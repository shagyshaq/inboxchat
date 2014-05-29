@extends('layouts/adminMaster')

@section('content')
<div class='resize'align='center'>
    <?php $error = Session::get('validateError');
    if (!empty($error)) {
        ?>
        <div class="alert alert-warning clearfix">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                    <?php foreach ($error as $err) { ?>
                    <li class="errorMessages">
                    <?php echo $err; ?>                   
                    </li>
    <?php } ?>
            </ul>  
        </div>
<?php } ?>

    <h1>{{isset($post) ? 'Edit' : 'Create'}} Message</h1>
    
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
        {{Form::text('toemail',Input::old('toemail', isset($post) ? $post->title : ''), array('placeholder'=>'Email','class'  => 'form-control'),isset($post) ? $post->title : '')}}<br>
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
        {{Form::text('subject',Input::old('subject', isset($post) ? $post->title_alias : ''), array('placeholder'=>'Subject','class'  => 'form-control'),isset($post) ? $post->title_alias : '')}}<br>
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
        {{Form::textarea('contentmessage',Input::old('contentmessage', isset($post) ? $post->full_text : ''), array('placeholder'=>'Content','class'  => 'form-control', 'cols' => '100'),isset($post) ? $post->full_text : '')}}
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

    @stop

    @section('additionalScripts')
    <script src="{{ URL::to('js/plugins/tinyMCE/tinymce.min.js') }}"></script>
    <script src="{{ URL::to('js/custom/admin.pages.js') }}"></script>
    @stop
