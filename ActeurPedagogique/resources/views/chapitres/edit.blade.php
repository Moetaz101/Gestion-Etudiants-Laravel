@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier le chapitre</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('chapitres.update', $chapitre) }}" method="POST">
            @csrf
            @method('PUT')
            
            @include('chapitres._form')
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Mettre à jour
                </button>
                <a href="{{ route('chapitres.show', $chapitre) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection