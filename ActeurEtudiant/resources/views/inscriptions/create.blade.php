@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Nouvelle inscription</h4>
        <a href="{{ route('inscriptions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('inscriptions.store') }}" method="POST">
            @include('inscriptions._form')
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Une note sera générée automatiquement lors de la création.
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer l'inscription
                </button>
            </div>
        </form>
    </div>
</div>
@endsection