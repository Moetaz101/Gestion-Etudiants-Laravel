@extends('layouts.app')

@section('title', 'Liste des évaluations')

@section('page-title', 'Liste des évaluations')

@section('content')
    <!-- Filtres de recherche -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('evaluations.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou prénom" value="{{ $search ?? '' }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="matiere" class="form-select">
                        <option value="">Toutes les matières</option>
                        @foreach($matieres as $m)
                            <option value="{{ $m }}" {{ (isset($matiere) && $matiere == $m) ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary w-100">Réinitialiser</a>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('evaluations.create') }}" class="btn btn-success w-100" title="Ajouter">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des évaluations -->
    <div class="card">
        <div class="card-body">
            @if($evaluations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <a href="{{ route('evaluations.index', array_merge(request()->query(), ['sort' => 'etudiant_nom', 'direction' => $sortColumn == 'etudiant_nom' && $sortDirection == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                                        Nom
                                        @if($sortColumn == 'etudiant_nom')
                                            <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                        @else
                                            <i class="fas fa-sort ms-1 text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('evaluations.index', array_merge(request()->query(), ['sort' => 'etudiant_prenom', 'direction' => $sortColumn == 'etudiant_prenom' && $sortDirection == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                                        Prénom
                                        @if($sortColumn == 'etudiant_prenom')
                                            <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                        @else
                                            <i class="fas fa-sort ms-1 text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('evaluations.index', array_merge(request()->query(), ['sort' => 'matiere', 'direction' => $sortColumn == 'matiere' && $sortDirection == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                                        Matière
                                        @if($sortColumn == 'matiere')
                                            <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                        @else
                                            <i class="fas fa-sort ms-1 text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('evaluations.index', array_merge(request()->query(), ['sort' => 'note', 'direction' => $sortColumn == 'note' && $sortDirection == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                                        Note
                                        @if($sortColumn == 'note')
                                            <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                        @else
                                            <i class="fas fa-sort ms-1 text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('evaluations.index', array_merge(request()->query(), ['sort' => 'date', 'direction' => $sortColumn == 'date' && $sortDirection == 'asc' ? 'desc' : 'asc'])) }}" class="text-decoration-none text-dark">
                                        Date
                                        @if($sortColumn == 'date')
                                            <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                        @else
                                            <i class="fas fa-sort ms-1 text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluations as $evaluation)
                                <tr>
                                    <td>{{ $evaluation->etudiant_nom }}</td>
                                    <td>{{ $evaluation->etudiant_prenom }}</td>
                                    <td>{{ $evaluation->matiere }}</td>
                                    <td>
                                        <span class="badge {{ $evaluation->note >= 10 ? 'bg-success' : 'bg-danger' }}">
                                            {{ number_format($evaluation->note, 2) }}/20
                                        </span>
                                    </td>
                                    <td>{{ $evaluation->date->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('evaluations.show', $evaluation) }}" class="btn btn-sm btn-info" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('evaluations.edit', $evaluation) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('evaluations.destroy', $evaluation) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?');">
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
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        Affichage de {{ $evaluations->firstItem() ?? 0 }} à {{ $evaluations->lastItem() ?? 0 }} sur {{ $evaluations->total() }} résultats
                    </div>
                    <div>
                        {{ $evaluations->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Aucune évaluation trouvée.
                </div>
                <div class="text-center">
                    <a href="{{ route('evaluations.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Ajouter une première évaluation
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection