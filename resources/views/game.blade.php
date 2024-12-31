<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Morpion (Tic-Tac-Toe)</title>
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
                        <a class="nav-link active" aria-current="page" href="{{ route('game.index') }}">Jeu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('leaderboard.index') }}">Leaderboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Morpion (Tic-Tac-Toe)</h1>

        <div class="text-center">
            @if ($winner)
            @if ($winner === 'Draw')
            <div class="alert alert-info" role="alert">
                Match nul !
            </div>
            @else
            <div class="alert alert-success" role="alert">
                Le joueur <strong>{{ $winner }}</strong> a gagné !
            </div>
            @endif
            @else
            <div class="alert alert-primary" role="alert">
                C’est au tour de : <strong>{{ $currentPlayer }}</strong>
            </div>
            @endif
        </div>

        {{-- Plateau 3x3 --}}
        <div class="d-flex flex-column align-items-center">
            @foreach($board as $rowIndex => $row)
            <div class="d-flex">
                @foreach($row as $colIndex => $cellValue)
                @php
                $cellBaseClass = "d-flex align-items-center justify-content-center
                border border-dark bg-light";
                $cellStyle = "width: 80px; height: 80px; font-size: 2rem;";
                @endphp

                @if ($winner || $cellValue !== '')
                {{-- Case non cliquable si la partie est finie ou déjà occupée --}}
                <div class="{{ $cellBaseClass }}" style="{{ $cellStyle }}">
                    {{ $cellValue }}
                </div>
                @else
                {{-- Case cliquable --}}
                <a
                    href="{{ route('game.play', ['row' => $rowIndex, 'col' => $colIndex]) }}"
                    class="{{ $cellBaseClass }}"
                    style="{{ $cellStyle }} text-decoration: none; color: black;">
                    {{ $cellValue }}
                </a>
                @endif
                @endforeach
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('game.reset') }}" class="btn btn-danger">
                Réinitialiser
            </a>
        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>