<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GameController extends Controller
{
    /**
     * Affiche la page du Morpion.
     */
    public function index(Request $request)
    {
        // Initialise la session si elle n'existe pas
        if (!$request->session()->has('board')) {
            $this->initGame($request);
        }

        return view('game', [
            'board'         => $request->session()->get('board'),
            'currentPlayer' => $request->session()->get('currentPlayer'),
            'winner'        => $request->session()->get('winner'),
            'movesCount'    => $request->session()->get('movesCount'),
        ]);
    }

    /**
     * Gère le clic sur une case (row, col).
     */
    public function play(Request $request, $row, $col)
    {
        $board         = $request->session()->get('board');
        $currentPlayer = $request->session()->get('currentPlayer');
        $winner        = $request->session()->get('winner');
        $movesCount    = $request->session()->get('movesCount');

        // Valider les coordonnées (optionnel)
        if ($row < 0 || $row > 2 || $col < 0 || $col > 2) {
            return redirect()->route('game.index');
        }

        // Si la case est vide et pas de gagnant
        if ($board[$row][$col] === '' && !$winner) {
            $board[$row][$col] = $currentPlayer;
            $movesCount++;

            // Vérifier s'il y a un gagnant
            if ($this->checkWinner($board, $currentPlayer)) {
                $winner = $currentPlayer;
                // Sauvegarde
                $this->saveGameResult($winner);
            } elseif ($movesCount === 9) {
                // Match nul
                $winner = 'Draw';
                $this->saveGameResult(null); // null => match nul
            } else {
                // Changer de joueur
                $currentPlayer = ($currentPlayer === 'X') ? 'O' : 'X';
            }
        }

        // Mise à jour de la session
        $request->session()->put('board', $board);
        $request->session()->put('currentPlayer', $currentPlayer);
        $request->session()->put('winner', $winner);
        $request->session()->put('movesCount', $movesCount);

        return redirect()->route('game.index');
    }

    /**
     * Réinitialise la partie
     */
    public function reset(Request $request)
    {
        $this->initGame($request);
        return redirect()->route('game.index');
    }

    /**
     * Initialise la session pour la partie
     */
    private function initGame(Request $request)
    {
        $board = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $request->session()->put('board', $board);
        $request->session()->put('currentPlayer', 'X');
        $request->session()->put('winner', null);
        $request->session()->put('movesCount', 0);
    }

    /**
     * Vérifie si le joueur courant est gagnant.
     */
    private function checkWinner(array $board, string $player): bool
    {
        // Lignes
        for ($i = 0; $i < 3; $i++) {
            if ($board[$i][0] === $player && $board[$i][1] === $player && $board[$i][2] === $player) {
                return true;
            }
        }
        // Colonnes
        for ($j = 0; $j < 3; $j++) {
            if ($board[0][$j] === $player && $board[1][$j] === $player && $board[2][$j] === $player) {
                return true;
            }
        }
        // Diagonales
        if ($board[0][0] === $player && $board[1][1] === $player && $board[2][2] === $player) {
            return true;
        }
        if ($board[0][2] === $player && $board[1][1] === $player && $board[2][0] === $player) {
            return true;
        }

        return false;
    }

    /**
     * Sauvegarde le résultat (winner = 'X', 'O' ou null) dans la base de données
     */
    private function saveGameResult($winner)
    {
        Game::create([
            'winner'    => $winner, // null => match nul
            'played_at' => Carbon::now(),
        ]);
    }
}
