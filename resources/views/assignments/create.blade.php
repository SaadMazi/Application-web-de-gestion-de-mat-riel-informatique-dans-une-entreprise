@extends('layout')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3>Affecter un matériel</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('assignments.store') }}" method="POST">
            @csrf <div class="mb-3">
                <label for="user_id" class="form-label">Employé</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Choisir un employé --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="material_id" class="form-label">Matériel Disponible</label>
                <select name="material_id" id="material_id" class="form-select" required>
                    <option value="">-- Choisir un matériel --</option>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}">
                            {{ $material->name }} - S/N: {{ $material->serial_number }}
                        </option>
                    @endforeach
                </select>
                @if($materials->isEmpty())
                    <small class="text-danger">Aucun matériel disponible en stock !</small>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Valider l'affectation</button>
        </form>
    </div>
</div>
@endsection
