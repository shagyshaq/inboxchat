@extends('layouts/adminMaster')

@section('content')

<h1 class="signin-h1"> List Users </h1>
    
        <a href="{{ url('messages/create/') }}" class="btn btn-primary btn-lg active"  role="button">Create new Message</a><br><br>
  
        <div>   
            <table class="table table-hover">
                <tr>
                    <td><b>#</b></td>
                    <td><b>Sender</b></td>
                    <td><b>Subject</b></td>
                    <td><b>Date</b></td>
                    <td></td>
                </tr>
                {{$messagesinbox}}
                @foreach ($messagesinbox as $inboxmessage)
                <tr onclick="window.location='{{ url('messages/view/'.$inboxmessage->id_message) }}'">
                    <td>{{$inboxmessage->id}}</td>
                    <td>{{$inboxmessage->email}}</td> 
                    <td>{{$inboxmessage->subject}}</td> 
                    <td>{{$inboxmessage->created_at}}</td>
<!--                    <td>{{$inboxmessage->active}}</td>-->
                    <td><a href="{{ url('users/edituser/'.$inboxmessage->id) }}"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="bottom" title="Edit User"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                
                        <a href="#" class="deleteuser" id="{{ 'deleteuser_'.$inboxmessage->id }}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="bottom" title="Delete User"></span></a>
                    
                    </td>
                </tr>
                @endforeach
            </table>
 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
      </div>
      <div class="modal-body">
        Are you sure yo want to delete this user?
      </div>
      <div class="modal-footer">
     <a href="#" id="confdeleteuser" class="btn btn-primary">Delete</a>
    <a href="#" id="canceldeluser" class="btn">Cancel</a>  
  </div>
    </div>
  </div>
</div>
              
	</div>
         
        @stop

