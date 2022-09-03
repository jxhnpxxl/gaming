@extends('points.layout')
@section('content')
<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div >
            <h2>Gamer</h2>
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

    <div class="col-xs-12 col-sm-12 col-md-12">
        <label for="my-select">Select a Team</label>
        <select name="team_code" id="team_code" required>
            <option value="" disabled selected>Select a Team</option>
            <?php foreach ($teams as $team): ?>
                <option value="<?= htmlspecialchars($team['team_code']) ?>">
                    <?= htmlspecialchars($team['team_name']) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
        <a href="{{ route('players.list', ['team_code' => $team_code]) }}" class="btn btn-danger">Cancel</a>
    </div>


    <form name="custForm" action="{{ route('points.store') }}" method="POST">
                    <input type="hidden" name="team_code" id="team_code" >
                    @csrf
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="my-select">Select a Team</label>
                            <select name="team_code" id="team_code" required>
                                <option value="" disabled selected>Select a Team</option>
                                <?php foreach ($teams as $team): ?>
                                    <option value="<?= htmlspecialchars($team['team_code']) ?>">
                                        <?= htmlspecialchars($team['team_name']) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Points:</strong>
                                <input type="text" name="points" id="points" class="form-control" value="{{ $points->point }}" onchange="validate()" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
                            <a href="{{ route('points.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
</div>

@endsection

