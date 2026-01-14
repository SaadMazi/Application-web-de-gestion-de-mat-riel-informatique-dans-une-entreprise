@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestion des Administrateurs</h1>
    <a href="{{ route('admins.create') }}" class="btn btn-dark border-white shadow">+ Nouvel Admin</a>
</div>

<div class="card border-dark">
    <div class="card-header bg-dark text-white">
        Équipe IT (Accès complet)
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Créé le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>
                        <strong>{{ $admin->name }}</strong>
                        @if(auth()->id() == $admin->id)
                            <span class="badge bg-success ms-2">C'est vous</span>
                        @endif
                    </td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if(auth()->id() != $admin->id)
                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Retirer les droits d\'administration à cette personne ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Indélébile</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
