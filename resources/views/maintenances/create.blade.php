@extends('layout')

@section('content')
<div class="card">
    <div class="card-header bg-danger text-white">
        <h3>Signaler une Panne</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('maintenances.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Matériel concerné</label>
                <select name="material_id" class="form-select" required>
                    @foreach($materials as $m)
                        <option value="{{ $m->id }}">
                            {{ $m->name }} ({{ $m->serial_number }}) - État actuel: {{ $m->status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Description du problème</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Ex: Écran bleu, ne démarre plus..." required></textarea>
            </div>

            <button type="submit" class="btn btn-danger">Déclarer HS</button>
        </form>
    </div>
</div>
@endsection
