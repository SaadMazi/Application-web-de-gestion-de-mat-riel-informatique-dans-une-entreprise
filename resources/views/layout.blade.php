<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Parc Informatique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">IT Manager</a>
            <div class="navbar-nav">
            <div class="navbar-nav">
                @if(Auth::user()->role === 'admin')
                <a class="nav-link" href="{{ route('employees.index') }}">Employés</a>
                <a class="nav-link" href="{{ route('admins.index') }}">Gestion Admins</a>
                @endif
                <a class="nav-link" href="{{ route('materials.index') }}">Gérer le Stock</a>
                <a class="nav-link" href="{{ route('assignments.index') }}">Affectations</a>
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link text-danger" href="{{ route('maintenances.index') }}">Maintenance</a>

            </div>
        </div>
        <div class="d-flex align-items-center">
    @auth
        <span class="text-white me-3">Bonjour, {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-light btn-sm">Déconnexion</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Se connecter</a>
    @endauth
</div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

</body>
</html>
