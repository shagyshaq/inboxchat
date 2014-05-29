@extends('layouts/adminMaster')

@section('content')

<h1 class="signin-h1"> Sent Messages </h1>

<a href="{{ url('messages/create/') }}" class="btn btn-primary btn-lg active"  role="button">Create new Message</a><br><br>

<div>
    
    <table class="table table-hover">
        <tr>
            <td><b>#</b></td>
            <td><b>Receiver</b></td>
            <td><b>Subject</b></td>
            <td><b>Date</b></td>
            <td></td>
        </tr>
        
        @foreach ($messagessent as $sentmessage)
        
        <tr class="za{{$sentmessage->read}}ra">
        
            <td><strong>{{$sentmessage->id}}</strong></td>
            <td>{{$sentmessage->email}}</td>
            <td>{{$sentmessage->subject}}</td>
            <td>{{$sentmessage->created_at}}</td>

            <td>
                <a href="{{ url('users/edituser/'.$sentmessage->id) }}"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="bottom" title="Edit User"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="deleteuser" id="{{ 'deleteuser_'.$sentmessage->id }}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="bottom" title="Delete User"></span></a>
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

