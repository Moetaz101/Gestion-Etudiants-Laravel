@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Détails du chapitre</h5>
        <div>
            <a href="{{ route('chapitres.edit', $chapitre) }}" class="btn btn-sm btn-warning text-white">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('matieres.show', $chapitre->matiere_id) }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour à la matière
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <h3>{{ $chapitre->titre }}</h3>
            <div class="d-flex mb-3">
                <span class="badge bg-primary me-2">
                    <i class="fas fa-book me-1"></i>{{ $chapitre->matiere->nom_matiere }}
                </span>
                <span class="badge bg-secondary">
                    <i class="fas fa-layer-group me-1"></i>{{ $chapitre->matiere->niveau }}
                </span>
            </div>
            <div class="small text-muted mb-4">
                <i class="fas fa-clock me-1"></i>Créé le {{ $chapitre->created_at->format('d/m/Y à H:i') }}
                @if($chapitre->updated_at->gt($chapitre->created_at))
                    | <i class="fas fa-edit me-1"></i>Mis à jour le {{ $chapitre->updated_at->format('d/m/Y à H:i') }}
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h6 class="mb-0">Contenu du chapitre</h6>
            </div>
            <div class="card-body">
                <div class="chapitre-content">
                    {!! nl2br(e($chapitre->contenu)) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white d-flex justify-content-between">
        <form action="{{ route('chapitres.destroy', $chapitre) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce chapitre ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash me-1"></i>Supprimer
            </button>
        </form>
        
        <div>
            <a href="{{ route('chapitres.index', ['matiere_id' => $chapitre->matiere_id]) }}" class="btn btn-outline-secondary">
                <i class="fas fa-list me-1"></i>Voir tous les chapitres
            </a>
        </div>
    </div>
</div>
@endsection