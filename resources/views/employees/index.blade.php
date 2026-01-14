@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Liste du Personnel</h1>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Nouvel Employé</a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date d'arrivée</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Supprimer cet employé ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">X</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
