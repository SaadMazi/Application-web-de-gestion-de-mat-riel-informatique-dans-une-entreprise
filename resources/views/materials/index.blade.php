@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Stock Informatique</h1>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('materials.create') }}" class="btn btn-primary">+ Ajouter Matériel</a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Catégorie</th>
                    <th>Nom</th>
                    <th>N° Série</th>
                    <th>État</th>
                    @if(Auth::user()->role === 'admin')
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($materials as $m)
                <tr>
                    <td>{{ $m->category->name ?? 'Aucune' }}</td>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->serial_number }}</td>
                    <td>
                        @if($m->status == 'available')
                            <span class="badge bg-success">Disponible</span>
                        @elseif($m->status == 'assigned')
                            <span class="badge bg-warning text-dark">Affecté</span>
                        @else
                            <span class="badge bg-danger">Panne/Autre</span>
                        @endif
                    </td>
                    @if(Auth::user()->role === 'admin')
                    <td>

                        <form action="{{ route('materials.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Supprimer ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">X</button>
                        </form>

                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
