<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            // 'winner': 'X', 'O', ou null pour match nul
            $table->string('winner')->nullable();
            // date/heure de la partie
            $table->timestamp('played_at');
            // champs created_at / updated_at par défaut
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
};
