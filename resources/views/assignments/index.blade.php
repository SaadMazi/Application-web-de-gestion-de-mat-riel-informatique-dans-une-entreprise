@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Matériels Affectés (En cours)</h1>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('assignments.create') }}" class="btn btn-primary">
        + Nouvelle Affectation
    </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        @if($assignments->isEmpty())
            <p class="text-center text-muted">Aucun matériel n'est affecté pour le moment.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Matériel</th>
                        <th>N° Série</th>
                        <th>Date début</th>
                        @if(Auth::user()->role === 'admin')
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->user->name }}</td>
                        <td>{{ $assignment->material->name }}</td>
                        <td><code>{{ $assignment->material->serial_number }}</code></td>
                        <td>{{ $assignment->start_date }}</td>
                        <td>
                            @if(Auth::user()->role === 'admin')
                            <form action="{{ route('assignments.return', $assignment->id) }}" method="POST" onsubmit="return confirm('Confirmer la restitution ?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Restituer (Rendre)
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
