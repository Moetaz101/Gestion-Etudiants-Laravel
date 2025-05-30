@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Ajouter un nouvel étudiant</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('etudiants.store') }}" method="POST">
            @include('etudiants._form')
            
            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i>Enregistrer
                </button>
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                </a>
            </div>
        </form>
    </div>
</div>
@endsection