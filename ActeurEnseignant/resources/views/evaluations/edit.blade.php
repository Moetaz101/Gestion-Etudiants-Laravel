@extends('layouts.app')

@section('title', 'Modifier une évaluation')

@section('page-title', 'Modifier l\'évaluation')

@section('content')
    <div class="card">
        <div class="card-header bg-warning bg-opacity-25">
            <h5 class="card-title mb-0">
                <i class="fas fa-edit me-2"></i>Modification de l'évaluation de {{ $evaluation->etudiant_prenom }} {{ $evaluation->etudiant_nom }}
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('evaluations.update', $evaluation) }}" method="POST">
                @csrf
                @method('PUT')
                
                @include('evaluations._form')
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection