@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-danger">Matériel en Maintenance</h1>
    <a href="{{ route('maintenances.create') }}" class="btn btn-danger">+ Signaler Panne</a>
</div>

<div class="card border-danger">
    <div class="card-body">
        @if($maintenances->isEmpty())
            <p class="text-success">Tout va bien ! Aucun matériel en panne.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Matériel</th>
                        <th>Problème</th>
                        <th>Date signalement</th>
                        @if(Auth::user()->role === 'admin')
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintenances as $ticket)
                    <tr>
                        <td>{{ $ticket->material->name }}</td>
                        <td>{{ $ticket->description_probleme ?? $ticket->description }}</td>
                        <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                        @if(Auth::user()->role === 'admin')
                        <td>
                            <form action="{{ route('maintenances.close', $ticket->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">Réparé (Remettre en stock)</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
