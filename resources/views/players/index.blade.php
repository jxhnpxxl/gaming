@extends('players.layout')
@section('content')
<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div >
            <h2>Game Tournament Points and Standings</h2>
        </div>
        <br/>
        <div >
            <h3>Players</h3>
        </div>
        <br/>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p id="msg">{{ $message }}</p>
</div>
@endif

<div class="float-container">
    <div  class="float-child">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-player" data-toggle="modal" style="margin-right:275px"><i class="fa fa-plus" title="add"></i> New player</a>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="float-child">
        <form action="{{ route('players.index') }}" method="GET" role="search">

            <div class="input-group">
                <span class="input-group-btn mr-2 mt-1">
                    <button class="btn btn-info" type="submit" title="Search players">
                    <i class="fa fa-search"></i> Search
                    </button>
                </span>
                <input type="text" class="form-control mr-2" name="term" placeholder="Search players" id="term">
                
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($players as $player)
    <tr id="player_id_{{ $player->player_id }}">
        <td>{{ $player->player_id }} </td>
        <td>{{ $player->first_name }} {{ $player->last_name }}</td>
        <td>{{ $player->email }}</td>
        <td>{{ $player->role }}</td>
        <td>
            <form action="{{ route('players.destroy',$player->player_id) }}" method="POST">
                <a class="btn btn-info" id="show-player" data-toggle="modal" data-id="{{ $player->player_id }}"><i class="fa fa-eye" title="show"></i> Show</a>
                <a href="javascript:void(0)" class="btn btn-success" id="edit-player" data-toggle="modal" data-id="{{ $player->player_id }}"> <i class="fa fa-pencil" title="Edit"></i> Edit</a>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <a id="delete-player" data-id="{{ $player->player_id }}" class="btn btn-danger delete-user"><i class="fa fa-remove" title="Remove"></i> Delete</a>
            </td>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $players->links() !!}

<!-- Add and Edit Players modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="playerCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="custForm" action="{{ route('players.store') }}" method="POST">
                    <input type="hidden" name="player_id" id="player_id" >
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Team:</strong>
                                <input type="text" name="team_code" id="team_code" class="form-control" value="{{ $team_code }}"  placeholder="{{ $team_code }}" readonly="readonly" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>First Name:</strong>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" onchange="validate()" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Last Name:</strong>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" onchange="validate()" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Username:</strong>
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Username" onchange="validate()" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="email" name="email" id="email" class="form-control" maxlength="70" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email" onchange="validate()">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Choose Gaming Role:</strong>
                                <select list="roles" name="role" id="role" class="form-control" placeholder="Role" onchange="validate()" >
                                <datalist id="roles">
                                    <option value="Jungler">Jungler</option>
                                    <option value="Tank">Tank</option>
                                    <option value="Midlane">Midlane</option>
                                    <option value="Turtle Lane">Turtle Lane</option>
                                    <option value="Non-Turtle Lane">Non-Turtle Lane</option>
                                </datalist>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
                            <a href="{{ route('players.list', ['team_code' => $team_code]) }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Show player modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="playerCrudModal-show"></h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-2 col-sm-2 col-md-2"></div>
               <div class="col-xs-10 col-sm-10 col-md-10 ">
                  @if(isset($player->player_id))
                  <table>
                        <tr>
                            <td><strong>Team Code:</strong></td>
                            <td>{{$player->team_code}}</td>
                        </tr>
                        <tr>
                            <td><strong>First Name:</strong></td>
                            <td>{{$player->first_name}}</td>
                        </tr>
                        <tr>
                            <td><strong>Last Name:</strong></td>
                            <td>{{$player->last_name}}</td>
                        </tr>
                        <tr>
                            <td><strong>Last Name:</strong></td>
                            <td>{{$player->user_name}}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{$player->email}}</td>
                        </tr>
                        <tr>
                            <td><strong>Role:</strong></td>
                            <td>{{$player->role}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right "><a href="{{ route('players.list', ['team_code' => $team_code]) }}" class="btn btn-danger">OK</a> </td>
                        </tr>
                  </table>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

<script>
    error=false
    function validate()
    {
        if(document.custForm.first_name.value !='' && document.custForm.last_name.value !='' && document.custForm.email.value !='' && document.custForm.user_name.value !='' && document.custForm.role.value !='' && document.custForm.team_code.value !='')
            document.custForm.btnsave.disabled=false
        else
            document.custForm.btnsave.disabled=true
    }
</script>