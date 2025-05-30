@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-warning text-white">
        <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Modifier l'étudiant</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
            @method('PUT')
            @include('etudiants._form')
            
            <div class="mt-4">
                <button type="submit" class="btn btn-warning text-white">
                    <i class="fas fa-save me-1"></i>Mettre à jour
                </button>
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                </a>
            </div>
        </form>
    </div>
</div>
@endsection