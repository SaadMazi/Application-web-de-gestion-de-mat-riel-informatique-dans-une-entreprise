@extends('layout')

@section('content')
<div class="card" style="max-width: 600px; margin: auto;">
    <div class="card-header bg-primary text-white">
        <h3>Nouvel Employé</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nom complet</label>
                <input type="text" name="name" class="form-control" placeholder="Ex: Jean Dupont" required>
            </div>

            <div class="mb-3">
                <label>Adresse Email</label>
                <input type="email" name="email" class="form-control" placeholder="Ex: jean.dupont@entreprise.com" required>
            </div>

            <div class="mb-3">
                <label>Mot de passe (pour sa connexion)</label>
                <input type="password" name="password" class="form-control" placeholder="Minimum 6 caractères" required>
            </div>

            <button type="submit" class="btn btn-success">Créer le compte</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
