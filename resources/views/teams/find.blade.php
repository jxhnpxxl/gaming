@extends('teams.layout')
@section('content')
<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div >
            <h2>Game Tournament Points and Standings</h2>
        </div>
        <br/>
        <div >
            <h3>Rankings</h3>
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
        <form action="{{ route('teams.ranks') }}" method="GET" role="search">

            <div class="input-group">
                <input type="text" class="form-control mr-2" name="term" placeholder="Search Teams" id="term">
                <span class="input-group-btn mr-2 mt-1">
                    <button class="btn btn-info" type="submit" title="Search Teams">
                    <i class="fa fa-search"></i> Search
                    </button>
                </span>
                <a href="{{ route('teams.ranks') }}" class=" mt-1">
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
        <th>Rankings</th>
        <th>Team Code</th>
        <th>Team Name</th>
        <th>Organization</th>
        <th width="350px">Action</th>
    </tr>
    @foreach ($teams as $team)
    <tr id="team_id_{{ $team['team_code'] }}">
        <td>{{ $team['rank'] }} </td>
        <td>{{ $team['team_code'] }} </td>
        <td>{{ $team['team_name'] }}</td>
        <td>{{ $team['organization'] }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('players.list', ['team_code' => $team['team_code']]) }}">Show Players</a>
            </td>
        </td>
    </tr>
    @endforeach
</table>

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <a href="{{ route('games.index') }}" class="btn btn-danger">Back</a>
</div>


@endsection