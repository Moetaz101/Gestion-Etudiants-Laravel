@extends('layouts.app')

@section('title', 'Détails de l\'évaluation')

@section('page-title', 'Détails de l\'évaluation')

@section('content')
    <div class="card">
        <div class="card-header bg-info bg-opacity-25">
            <h5 class="card-title mb-0">
                <i class="fas fa-clipboard-list me-2"></i>Évaluation de {{ $evaluation->etudiant_prenom }} {{ $evaluation->etudiant_nom }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="border-bottom pb-2 mb-3">Informations de l'étudiant</h4>
                    <p><strong>Nom :</strong> {{ $evaluation->etudiant_nom }}</p>
                    <p><strong>Prénom :</strong> {{ $evaluation->etudiant_prenom }}</p>
                </div>
                <div class="col-md-6">
                    <h4 class="border-bottom pb-2 mb-3">Informations de l'évaluation</h4>
                    <p>
                        <strong>Matière :</strong> 
                        <span class="badge bg-primary">{{ $evaluation->matiere }}</span>
                    </p>
                    <p>
                        <strong>Note :</strong> 
                        <span class="badge {{ $evaluation->note >= 10 ? 'bg-success' : 'bg-danger' }}">
                            {{ number_format($evaluation->note, 2) }}/20
                        </span>
                        <span class="ms-2 text-muted">
                            @if($evaluation->note >= 16)
                                <i class="fas fa-trophy text-success"></i> Excellent
                            @elseif($evaluation->note >= 14)
                                <i class="fas fa-star text-success"></i> Très bien
                            @elseif($evaluation->note >= 12)
                                <i class="fas fa-smile text-success"></i> Bien
                            @elseif($evaluation->note >= 10)
                                <i class="fas fa-check text-success"></i> Passable
                            @elseif($evaluation->note >= 8)
                                <i class="fas fa-exclamation-circle text-warning"></i> Insuffisant
                            @else
                                <i class="fas fa-times-circle text-danger"></i> Très insuffisant
                            @endif
                        </span>
                    </p>
                    <p><strong>Date de l'évaluation :</strong> {{ $evaluation->date->format('d/m/Y') }}</p>
                </div>
            </div>

            @if($evaluation->message)
                <div class="row mt-3">
                    <div class="col-12">
                        <h4 class="border-bottom pb-2 mb-3">Commentaire</h4>
                        <div class="p-3 bg-light rounded">
                            {{ $evaluation->message }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                        </a>
                        <div>
                            <a href="{{ route('evaluations.edit', $evaluation) }}" class="btn btn-warning me-2">
                                <i class="fas fa-edit me-1"></i>Modifier
                            </a>
                            <form action="{{ route('evaluations.destroy', $evaluation) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-1"></i>Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <small>
                <i class="fas fa-clock me-1"></i>Créé le : {{ $evaluation->created_at->format('d/m/Y à H:i') }}
                @if($evaluation->updated_at->gt($evaluation->created_at))
                    <span class="ms-3"><i class="fas fa-history me-1"></i>Dernière modification : {{ $evaluation->updated_at->format('d/m/Y à H:i') }}</span>
                @endif
            </small>
        </div>
    </div>
@endsection