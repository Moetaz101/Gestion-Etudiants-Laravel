@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-users me-2"></i>Liste des étudiants</h4>
    </div>
    <div class="card-body">
        <!-- Recherche -->
        <form action="{{ route('etudiants.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher par matricule, nom ou prénom..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i>Rechercher
                </button>
                @if(isset($search) && $search)
                    <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Réinitialiser
                    </a>
                @endif
            </div>
        </form>

        @if($etudiants->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="{{ route('etudiants.index', [
                                    'sort' => 'id', 
                                    'direction' => ($sortField == 'id' && $sortDirection == 'asc') ? 'desc' : 'asc',
                                    'search' => $search ?? ''
                                ]) }}" class="text-decoration-none text-dark">
                                    ID
                                    @if($sortField == 'id')
                                        <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('etudiants.index', [
                                    'sort' => 'matricule', 
                                    'direction' => ($sortField == 'matricule' && $sortDirection == 'asc') ? 'desc' : 'asc',
                                    'search' => $search ?? ''
                                ]) }}" class="text-decoration-none text-dark">
                                    Matricule
                                    @if($sortField == 'matricule')
                                        <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('etudiants.index', [
                                    'sort' => 'nom', 
                                    'direction' => ($sortField == 'nom' && $sortDirection == 'asc') ? 'desc' : 'asc',
                                    'search' => $search ?? ''
                                ]) }}" class="text-decoration-none text-dark">
                                    Nom
                                    @if($sortField == 'nom')
                                        <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('etudiants.index', [
                                    'sort' => 'prenom', 
                                    'direction' => ($sortField == 'prenom' && $sortDirection == 'asc') ? 'desc' : 'asc',
                                    'search' => $search ?? ''
                                ]) }}" class="text-decoration-none text-dark">
                                    Prénom
                                    @if($sortField == 'prenom')
                                        <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Classe</th>
                            <th>Sexe</th>
                            <th>Spécialité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->id }}</td>
                                <td>{{ $etudiant->matricule }}</td>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->prenom }}</td>
                                <td>{{ $etudiant->classe }}</td>
                                <td>
                                    @if($etudiant->sexe == 'Homme')
                                        <span class="badge bg-primary"><i class="fas fa-male me-1"></i>{{ $etudiant->sexe }}</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fas fa-female me-1"></i>{{ $etudiant->sexe }}</span>
                                    @endif
                                </td>
                                <td>{{ $etudiant->specialite }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-sm btn-info text-white" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-sm btn-warning text-white" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')">
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
            
            <!-- Pagination -->
            <div class="d-flex justify-content-end">
                {{ $etudiants->appends([
                    'sort' => $sortField,
                    'direction' => $sortDirection,
                    'search' => $search ?? ''
                ])->links() }}
            </div>
            
            <div class="mt-3">
                <p class="text-muted">
                    Affichage de {{ $etudiants->firstItem() ?? 0 }} à {{ $etudiants->lastItem() ?? 0 }} sur {{ $etudiants->total() }} étudiants
                </p>
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>Aucun étudiant trouvé.
                @if(isset($search) && $search)
                    <a href="{{ route('etudiants.index') }}" class="alert-link">Réinitialiser la recherche</a>
                @else
                    <a href="{{ route('etudiants.create') }}" class="alert-link">Ajouter un étudiant</a>
                @endif
            </div>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('etudiants.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-1"></i>Ajouter un étudiant
        </a>
    </div>
</div>
@endsection