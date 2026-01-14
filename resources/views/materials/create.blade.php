@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Nouveau Matériel</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('materials.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nom du matériel</label>
                <input type="text" name="name" class="form-control" placeholder="Ex: HP ProBook 450" required>
            </div>

            <div class="mb-3">
                <label>Numéro de Série</label>
                <input type="text" name="serial_number" class="form-control" placeholder="Ex: SN-998877" required>
            </div>

            <div class="mb-3">
                <label>Catégorie</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
