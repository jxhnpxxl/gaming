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
@endsection
