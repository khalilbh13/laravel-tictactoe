<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Récupération de toutes les parties (triées par la date de la partie desc)
        $games = Game::orderBy('played_at', 'desc')->get();

        return view('leaderboard', compact('games'));
    }
}
