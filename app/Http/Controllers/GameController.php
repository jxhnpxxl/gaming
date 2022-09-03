<?php
namespace App\Http\Controllers;
use Response;
use Redirect;

class GameController extends Controller
{
    /**
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('games.index');
    }
}