@extends('layout')

@section('content')
<div class="mb-4">
    <h1>Tableau de Bord</h1>
    <p class="text-muted">Vue d'ensemble du parc informatique</p>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Matériel</div>
            <div class="card-body">
                <h1 class="card-title">{{ $totalMateriel }}</h1>
                <p class="card-text">équipements enregistrés</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">En Stock (Dispo)</div>
            <div class="card-body">
                <h1 class="card-title">{{ $dispo }}</h1>
                <p class="card-text">prêts à être affectés</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-dark bg-warning mb-3">
            <div class="card-header">Affectés</div>
            <div class="card-body">
                <h1 class="card-title">{{ $affecte }}</h1>
                <p class="card-text">actuellement utilisés</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">En Maintenance</div>
            <div class="card-body">
                <h1 class="card-title">{{ $panne }}</h1>
                <p class="card-text">nécessitent réparation</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">Actions Rapides</div>
            <div class="list-group list-group-flush">
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('assignments.create') }}" class="list-group-item list-group-item-action">
                    + Nouvelle Affectation
                </a>
                <a href="{{ route('materials.create') }}" class="list-group-item list-group-item-action">
                    + Ajouter un Matériel
                </a>
                @endif
                <a href="{{ route('maintenances.create') }}" class="list-group-item list-group-item-action text-danger">
                    ! Signaler une Panne
                </a>
            </div>
        </div>

        <div class="card">
             <div class="card-body text-center">
                 <h3 class="text-primary">{{ $totalEmployes }}</h3>
                 <span class="text-muted">Employés enregistrés</span>
             </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Derniers Mouvements
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <th>Matériel</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentAssignments as $a)
                        <tr>
                            <td>{{ $a->user->name }}</td>
                            <td>{{ $a->material->name }}</td>
                            <td>{{ $a->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end">
                    <a href="{{ route('assignments.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
