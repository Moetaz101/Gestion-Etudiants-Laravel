@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white">
        <h4 class="mb-0"><i class="fas fa-user me-2"></i>Détails de l'étudiant</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th class="bg-light" style="width: 30%">ID</th>
                        <td>{{ $etudiant->id }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Matricule</th>
                        <td>{{ $etudiant->matricule }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Nom</th>
                        <td>{{ $etudiant->nom }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Prénom</th>
                        <td>{{ $etudiant->prenom }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Classe</th>
                        <td>{{ $etudiant->classe }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Sexe</th>
                        <td>
                            @if($etudiant->sexe == 'Homme')
                                <span class="badge bg-primary"><i class="fas fa-male me-1"></i>{{ $etudiant->sexe }}</span>
                            @else
                                <span class="badge bg-danger"><i class="fas fa-female me-1"></i>{{ $etudiant->sexe }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Spécialité</th>
                        <td>{{ $etudiant->specialite }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Date de création</th>
                        <td>{{ $etudiant->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Dernière mise à jour</th>
                        <td>{{ $etudiant->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            @if($etudiant->sexe == 'Homme')
                                <i class="fas fa-user-graduate text-primary" style="font-size: 6rem;"></i>
                            @else
                                <i class="fas fa-user-graduate text-danger" style="font-size: 6rem;"></i>
                            @endif
                        </div>
                        <h4>{{ $etudiant->nom }} {{ $etudiant->prenom }}</h4>
                        <p class="text-muted mb-2">{{ $etudiant->matricule }}</p>
                        <div class="mb-3">
                            <span class="badge bg-secondary">{{ $etudiant->classe }}</span>
                            <span class="badge bg-dark">{{ $etudiant->specialite }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="btn-group">
            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour à la liste
            </a>
            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning text-white">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i>Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection