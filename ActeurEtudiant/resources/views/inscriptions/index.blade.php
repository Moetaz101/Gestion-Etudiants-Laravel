@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Liste des inscriptions</h4>
        <a href="{{ route('inscriptions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle inscription
        </a>
    </div>
    <div class="card-body">
        <!-- Formulaire de recherche -->
        <form action="{{ route('inscriptions.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher par nom de cours..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fas fa-search"></i> Rechercher
                </button>
                @if(!empty($search))
                    <a href="{{ route('inscriptions.index') }}" class="btn btn-outline-danger">
                        <i class="fas fa-times"></i> Effacer
                    </a>
                @endif
            </div>
        </form>

        @if($inscriptions->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ route('inscriptions.index', ['sort' => 'id', 'direction' => $sortField === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}" class="text-decoration-none text-dark">
                                    ID
                                    @if($sortField === 'id')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                        <i class="fas fa-sort"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('inscriptions.index', ['sort' => 'nom_cours', 'direction' => $sortField === 'nom_cours' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}" class="text-decoration-none text-dark">
                                    Cours
                                    @if($sortField === 'nom_cours')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                        <i class="fas fa-sort"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('inscriptions.index', ['sort' => 'date_inscription', 'direction' => $sortField === 'date_inscription' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}" class="text-decoration-none text-dark">
                                    Date d'inscription
                                    @if($sortField === 'date_inscription')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                        <i class="fas fa-sort"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('inscriptions.index', ['sort' => 'note', 'direction' => $sortField === 'note' && $sortDirection === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}" class="text-decoration-none text-dark">
                                    Note
                                    @if($sortField === 'note')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                        <i class="fas fa-sort"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inscriptions as $inscription)
                        <tr>
                            <td>{{ $inscription->id }}</td>
                            <td>{{ $inscription->nom_cours }}</td>
                            <td>{{ $inscription->date_inscription->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $inscription->note >= 10 ? 'success' : 'danger' }}">
                                    {{ number_format($inscription->note, 2) }}/20
                                </span>
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('inscriptions.show', $inscription) }}" class="btn btn-info btn-sm me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('inscriptions.edit', $inscription) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('inscriptions.destroy', $inscription) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette inscription?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $inscriptions->links() }}
            </div>
        @else
            <div class="alert alert-info">
                Aucune inscription trouvée. 
                @if(!empty($search))
                    <a href="{{ route('inscriptions.index') }}">Voir toutes les inscriptions</a>
                @else
                    <a href="{{ route('inscriptions.create') }}">Créer votre première inscription</a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection