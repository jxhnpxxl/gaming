<?php
namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;
use App\Models\Teams;
use App\Models\TeamPoints;
use Response;
use Redirect;

class TeamsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if (request('term')) {
            $teams = Teams::query()
                    ->where('team_name', 'Like', '%' . request('term') . '%')
                    ->orWhere('organization', 'Like', '%' . request('term') . '%')
                    ->orderBy('team_code', 'DESC')
                    ->paginate(5);
        }
        else {
            $teams = Teams::latest()->paginate(5);
        }

        return view('teams.index',compact('teams'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('teams.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
            'organization' => 'required',
        ]);

        Teams::updateOrCreate(['team_code' => $request->team_code], ['team_name' => $request->team_name, 'organization' => $request->organization]);

        if(empty($request->team_code))
            $msg = 'Teams entry created successfully.';
        else
            $msg = 'Teams data is updated successfully';

        return redirect()->route('teams.index')->with('success',$msg);
    }

    /**
    * Display the specified resource.
    *
    * @param int $teams
    * @return \Illuminate\Http\Response
    */
    public function show(Teams $teams)
    {
        return view('teams.show',compact('teams'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function edit($team_code)
    {
        $where = array('team_code' => $team_code);
        $teams = Teams::where($where)->first();

        return Response::json($teams);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $team_code
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $team_code
    * @return \Illuminate\Http\Response
    */
    public function destroy($team_code)
    {
        $team = Teams::where('team_code',$team_code)->delete();
        $team = Players::where('team_code',$team_code)->delete();

        return Response::json($team);
    }

    /**
    * @return \Illuminate\Http\Response
    */
    public function ranks()
    {
        $teams = collect([]);
        if (request('term')) {
            $teams_col = Teams::query()
                    ->where('team_name', 'Like', '%' . request('term') . '%')
                    ->orWhere('organization', 'Like', '%' . request('term') . '%');

            foreach($teams_col as $team) {
                $team = collect($team);

                $rank = $this->getRanking($team);
                $team->put('rank', $rank);

                $teams->push($team->toArray());
            }
        }
        else {
            $teams_col = collect(Teams::get());

            foreach($teams_col as $team) {
                $team = collect($team);

                $rank = $this->getRanking($team);
                $team->put('rank', $rank);

                $teams->push($team->toArray());
            }
        }
        $teams = $teams->values()->sortBy('rank');
        return view('teams.find',compact('teams'));
    }

    private function getRanking($team){
        $collection = collect(TeamPoints::orderBy('points', 'DESC')->get());
        $data       = $collection->where('team_code', $team['team_code']);
        $value      = $data->keys()->first() + 1;
        return $value;
     }
}