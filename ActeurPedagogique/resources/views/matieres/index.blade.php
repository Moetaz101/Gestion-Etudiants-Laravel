@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-book me-2"></i>Liste des matières</h5>
        <a href="{{ route('matieres.create') }}" class="btn btn-sm btn-light">
            <i class="fas fa-plus me-1"></i>Nouvelle matière
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('matieres.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une matière..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search'))
                    <a href="{{ route('matieres.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>

        @if($matieres->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="{{ route('matieres.index', ['sort' => 'nom_matiere', 'direction' => $sortField === 'nom_matiere' && $sortDirection === 'asc' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}" class="text-decoration-none text-dark">
                                    Nom
                                    @if($sortField === 'nom_matiere')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('matieres.index', ['sort' => 'niveau', 'direction' => $sortField === 'niveau' && $sortDirection === 'asc' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}" class="text-decoration-none text-dark">
                                    Niveau
                                    @if($sortField === 'niveau')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Chapitres</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matieres as $matiere)
                            <tr>
                                <td>{{ $matiere->nom_matiere }}</td>
                                <td>{{ $matiere->niveau }}</td>
                                <td>{{ $matiere->chapitres->count() }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('matieres.show', $matiere) }}" class="btn btn-sm btn-info text-white btn-action" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('matieres.edit', $matiere) }}" class="btn btn-sm btn-warning text-white btn-action" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('matieres.destroy', $matiere) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?');">
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
            <div class="d-flex justify-content-center">
                {{ $matieres->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>Aucune matière trouvée.
            </div>
        @endif
    </div>
</div>
@endsection