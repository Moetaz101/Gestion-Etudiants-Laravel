@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Modifier l'inscription #{{ $inscription->id }}</h4>
        <a href="{{ route('inscriptions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('inscriptions.update', $inscription) }}" method="POST">
            @method('PUT')
            @include('inscriptions._form')
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour l'inscription
                </button>
            </div>
        </form>
    </div>
</div>
@endsection