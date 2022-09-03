<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id("player_id");
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('user_name', 40)->unique();
            $table->string('email', 40)->unique();
            $table->string('role', 20);
            $table->string('team_code');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
}
