
@extends('games.layout')
 
 @section('content')
    <div class="row">
    <div class="col-lg-12" style="text-align: center">
            <div >
                <h2>Game Tournament Points and Standings</h2>
            </div>
            <br/>
        </div>
    </div>
    

    <div style="text-align: center">
    <a class="btn btn-info" href="{{ route('teams.ranks') }}"><i class="fa fa-search"></i> Team Rankings</a>
    <a class="btn btn-info" href="#"><i class="fa fa-search"></i> xSearch Playersx</a>
    <a class="btn btn-info" href="{{ route('teams.index') }}">Manage Teams</a>
    <a class="btn btn-info" href="#">xManage Pointsx</a>
    </div>

 @endsection