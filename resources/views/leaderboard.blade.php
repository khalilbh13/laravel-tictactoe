<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Leaderboard - Historique des Parties</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Morpion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('game.index') }}">Jeu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('leaderboard.index') }}">Leaderboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Leaderboard</h1>
        <p>Historique des parties (triées par date décroissante) :</p>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date de la partie</th>
                    <th>Gagnant</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>
                    <td>{{ $game->played_at }}</td>
                    <td>
                        @if ($game->winner === null)
                        <span class="text-muted">Match nul</span>
                        @else
                        {{ $game->winner }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('game.index') }}" class="btn btn-primary">
            Revenir au Jeu
        </a>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>