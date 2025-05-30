@extends('layouts.app')

@section('title', 'Ajouter une évaluation')

@section('page-title', 'Ajouter une nouvelle évaluation')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('evaluations.store') }}" method="POST">
                @csrf
                
                @include('evaluations._form')
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection