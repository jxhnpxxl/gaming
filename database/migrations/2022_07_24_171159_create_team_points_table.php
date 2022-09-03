<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamPointsTable extends Migration
{
    public function up(): void
    {
        Schema::create('team_points', function (Blueprint $table) {
            $table->id("team_code");
            $table->integer('points');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_points');
    }
}
