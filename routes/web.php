<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\TeamsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect()->route('games.index');
});


Route::resource('employees2', EmployeeController::class);
Route::resource('employees', EmployeesController::class);
Route::get('employees2/{id}/edit', [EmployeeController::class, 'edit']);



Route::resource('games', GameController::class);
Route::resource('players', PlayersController::class);
Route::get('/players/list/{team_code}', [PlayersController::class, 'list'])->name('players.list');
Route::get('/players/list/players/{player_id}/edit', [PlayersController::class, 'edit']);
Route::resource('points', PointsController::class);
Route::resource('teams', TeamsController::class);
Route::get('/rankings', [TeamsController::class, 'ranks'])->name('teams.ranks');
