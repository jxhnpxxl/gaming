<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Players;
use Response;
use Redirect;

class PlayersController extends Controller
{
    /**
    * Display the specified resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if (request('term')) {
            $players = Players::query()
                    ->where('first_name', 'Like', '%' . request('term') . '%')
                    ->orWhere('last_name', 'Like', '%' . request('term') . '%')
                    ->orWhere('user_name', 'Like', '%' . request('term') . '%')
                    ->orWhere('email', 'Like', '%' . request('term') . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(5);
        }
        else {
            $players = Players::latest()->paginate(5);
        }

        return view('players.index', compact('players'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

      /**
    * Display the specified resource.
    *
    * @param int $team_code
    * @return \Illuminate\Http\Response
    */
    public function list($team_code)
    {
        if (request('term')) {
            $players = Players::query()
                    ->where('first_name', 'Like', '%' . request('term') . '%')
                    ->orWhere('last_name', 'Like', '%' . request('term') . '%')
                    ->orWhere('user_name', 'Like', '%' . request('term') . '%')
                    ->orWhere('email', 'Like', '%' . request('term') . '%')
                    ->orWhere('team_code', $team_code)
                    ->orderBy('id', 'DESC')
                    ->paginate(5);
        }
        else {
            $players = Players::query()
                ->Where('team_code', $team_code)->paginate(5);
        }

        return view('players.index',compact('players', 'team_code'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('players.create');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'team_code' => 'required',
        ]);

        $team_code = $request->team_code;
        Players::updateOrCreate(['player_id' => $request->player_id],['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'role' => $request->role, 'user_name' => $request->user_name, 'team_code' => $request->team_code]);

        if(empty($request->player_id))
            $msg = 'Player entry created successfully.';
        else
            $msg = 'Player data is updated successfully';

        return redirect()->route('players.list', $team_code)->with('success',$msg);
    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function show(Players $player)
    {
        return view('players.show',compact('player'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $where = array('player_id' => $id);
        $player = Players::where($where)->first();
        return Response::json($player);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $player = Players::where('player_id',$id)->delete();
        return Response::json($player);
    }
}