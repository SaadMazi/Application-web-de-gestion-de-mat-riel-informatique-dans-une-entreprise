@extends('layout')

@section('content')
<div class="card border-dark shadow" style="max-width: 600px; margin: auto;">
    <div class="card-header bg-dark text-white">
        <h3><span class="text-warning">⚠</span> Ajouter un Administrateur</h3>
    </div>
    <div class="card-body">
        <div class="alert alert-warning">
            Attention : Cet utilisateur aura <strong>tous les droits</strong> (Supprimer, Créer, Modifier) sur l'application.
        </div>

        <form action="{{ route('admins.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nom complet</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email de connexion</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mot de passe temporaire</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-dark">Confirmer la création</button>
            <a href="{{ route('admins.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
