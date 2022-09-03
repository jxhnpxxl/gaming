<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;
    protected $primaryKey = 'player_id';
  
    protected $fillable = [
        'first_name', 'last_name', 'user_name', 'email', 'role', 'team_code' 
    ];
}
