@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-book me-2"></i>Détails de la matière</h5>
        <div>
            <a href="{{ route('matieres.edit', $matiere) }}" class="btn btn-sm btn-warning text-white">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('matieres.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="mb-1"><strong>Nom de la matière :</strong></p>
                <p>{{ $matiere->nom_matiere }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Niveau :</strong></p>
                <p>{{ $matiere->niveau }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Chapitres de la matière</h5>
        <a href="{{ route('chapitres.create', ['matiere_id' => $matiere->id]) }}" class="btn btn-sm btn-light">
            <i class="fas fa-plus me-1"></i>Nouveau chapitre
        </a>
    </div>
    <div class="card-body">
        @if($chapitres->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Titre</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chapitres as $chapitre)
                            <tr>
                                <td>{{ $chapitre->titre }}</td>
                                <td>{{ $chapitre->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('chapitres.show', $chapitre) }}" class="btn btn-sm btn-info text-white btn-action" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('chapitres.edit', $chapitre) }}" class="btn btn-sm btn-warning text-white btn-action" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('chapitres.destroy', $chapitre) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce chapitre ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $chapitres->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>Aucun chapitre n'a été créé pour cette matière.
            </div>
        @endif
    </div>
</div>
@endsection