@extends('teams.layout')
@section('content')
<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div >
            <h2>Game Tournament Points and Standings</h2>
        </div>
        <br/>
        <div >
            <h3>Teams</h3>
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
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-team" data-toggle="modal" style="margin-right:275px"><i class="fa fa-plus" title="add"></i> New team</a>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="float-child">
        <form action="{{ route('teams.index') }}" method="GET" role="search">

            <div class="input-group">
                <input type="text" class="form-control mr-2" name="term" placeholder="Search Teams" id="term">
                <span class="input-group-btn mr-2 mt-1">
                    <button class="btn btn-info" type="submit" title="Search Teams">
                    <i class="fa fa-search"></i> Search
                    </button>
                </span>
                <a href="{{ route('teams.index') }}" class=" mt-1">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button" title="Refresh page">
                        <i class="fa fa-refresh" title="refresh"></i> Refresh
                        </button>
                    </span>
                </a>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>Team Code</th>
        <th>Team Name</th>
        <th>Organization</th>
        <th width="350px">Action</th>
    </tr>
    @foreach ($teams as $team)
    <tr id="team_id_{{ $team->team_code }}">
        <td>{{ $team->team_code }} </td>
        <td>{{ $team->team_name }}</td>
        <td>{{ $team->organization }}</td>
        <td>
            <form action="{{ route('teams.destroy', $team->team_code)}}" method="POST">
                <a class="btn btn-info" href="{{ route('players.list', ['team_code' => $team->team_code]) }}">Show Players</a>
                <a href="javascript:void(0)" class="btn btn-success" id="edit-team" data-toggle="modal" data-id="{{ $team->team_code }}"> <i class="fa fa-pencil" title="Edit"></i> Edit</a>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <a id="delete-team" data-id="{{ $team->team_code }}" class="btn btn-danger delete-user"><i class="fa fa-remove" title="Remove"></i> Delete</a>
            </td>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <a href="{{ route('games.index') }}" class="btn btn-danger">Back</a>
</div>

{!! $teams->links() !!}

<!-- Add and Edit Team modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="teamCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="custForm" action="{{ route('teams.store') }}" method="POST">
                    <input type="hidden" name="team_code" id="team_code" >
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Team Name:</strong>
                                <input type="text" name="team_name" id="team_name" class="form-control" placeholder="Team Name" onchange="validate()" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Organization:</strong>
                                <input type="text" name="organization" id="organization" class="form-control" placeholder="Organization" onchange="validate()" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
                            <a href="{{ route('teams.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Show team modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="teamCrudModal-show"></h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-2 col-sm-2 col-md-2"></div>
               <div class="col-xs-10 col-sm-10 col-md-10 ">
                  @if(isset($team->team_code))
                  <table>
                        <tr>
                            <td><strong>Team Name:</strong></td>
                            <td>{{$team->team_name}}</td>
                        </tr>
                        <tr>
                            <td><strong>Organization:</strong></td>
                            <td>{{$team->organization}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right "><a href="{{ route('teams.index') }}" class="btn btn-danger">OK</a> </td>
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
        if(document.custForm.team_name.value !='' && document.custForm.organization.value !='')
            document.custForm.btnsave.disabled=false
        else
            document.custForm.btnsave.disabled=true
    }
</script>