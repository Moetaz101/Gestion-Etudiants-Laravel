@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Nouveau chapitre</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('chapitres.store') }}" method="POST">
            @csrf
            
            @include('chapitres._form')
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Enregistrer
                </button>
                
                @if(isset($matiere_id))
                    <a href="{{ route('matieres.show', $matiere_id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la matière
                    </a>
                @else
                    <a href="{{ route('chapitres.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection