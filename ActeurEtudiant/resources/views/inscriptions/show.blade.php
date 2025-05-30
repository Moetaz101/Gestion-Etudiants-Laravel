@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Détails de l'inscription #{{ $inscription->id }}</h4>
        <div>
            <a href="{{ route('inscriptions.edit', $inscription) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('inscriptions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 30%">ID</th>
                            <td>{{ $inscription->id }}</td>
                        </tr>
                        <tr>
                            <th>Nom du cours</th>
                            <td>{{ $inscription->nom_cours }}</td>
                        </tr>
                        <tr>
                            <th>Date d'inscription</th>
                            <td>{{ $inscription->date_inscription->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Note</th>
                            <td>
                                <span class="badge bg-{{ $inscription->note >= 10 ? 'success' : 'danger' }} fs-6">
                                    {{ number_format($inscription->note, 2) }}/20
                                </span>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-{{ $inscription->note >= 10 ? 'success' : 'danger' }}" 
                                         role="progressbar" 
                                         style="width: {{ ($inscription->note / 20) * 100 }}%" 
                                         aria-valuenow="{{ $inscription->note }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="20">
                                        {{ number_format($inscription->note, 2) }}/20
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Créée le</th>
                            <td>{{ $inscription->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Mise à jour le</th>
                            <td>{{ $inscription->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-{{ $inscription->note >= 10 ? 'success' : 'danger' }} text-white">
                        Résultat
                    </div>
                    <div class="card-body text-center">
                        <h1 class="display-1">{{ number_format($inscription->note, 2) }}</h1>
                        <p class="lead">sur 20</p>
                        <p class="mb-0">
                            @if($inscription->note >= 16)
                                <i class="fas fa-trophy"></i> Très bien
                            @elseif($inscription->note >= 14)
                                <i class="fas fa-star"></i> Bien
                            @elseif($inscription->note >= 12)
                                <i class="fas fa-thumbs-up"></i> Assez bien
                            @elseif($inscription->note >= 10)
                                <i class="fas fa-check"></i> Passable
                            @else
                                <i class="fas fa-times"></i> Insuffisant
                            @endif
                        </p>
                    </div>
                </div>
                
                <div class="d-grid gap-2 mt-3">
                    <form action="{{ route('inscriptions.destroy', $inscription) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette inscription?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Supprimer cette inscription
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection