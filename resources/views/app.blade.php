<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Morpion')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .nav a {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="nav">
        <a href="{{ route('game.index') }}">Jeu</a>
        <a href="{{ route('leaderboard.index') }}">Leaderboard</a>
    </div>
    <hr>
    @yield('content')
</body>

</html>