@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-list me-2"></i>
            @if(isset($matiere))
                Chapitres de {{ $matiere->nom_matiere }}
            @else
                Liste des chapitres
            @endif
        </h5>
        <div>
            @if(isset($matiereId))
                <a href="{{ route('chapitres.create', ['matiere_id' => $matiereId]) }}" class="btn btn-sm btn-light">
                    <i class="fas fa-plus me-1"></i>Nouveau chapitre
                </a>
                <a href="{{ route('matieres.show', $matiereId) }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la matière
                </a>
            @else
                <a href="{{ route('chapitres.create') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-plus me-1"></i>Nouveau chapitre
                </a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('chapitres.index') }}" method="GET" class="mb-4">
            @if(isset($matiereId))
                <input type="hidden" name="matiere_id" value="{{ $matiereId }}">
            @else
                <div class="mb-3">
                    <label for="matiere_filter" class="form-label">Filtrer par matière</label>
                    <select name="matiere_id" id="matiere_filter" class="form-select" onchange="this.form.submit()">
                        <option value="">Toutes les matières</option>
                        @foreach(App\Models\Matiere::orderBy('nom_matiere')->get() as $mat)
                            <option value="{{ $mat->id }}" {{ request('matiere_id') == $mat->id ? 'selected' : '' }}>
                                {{ $mat->nom_matiere }} ({{ $mat->niveau }})
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un chapitre..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search') || request('matiere_id'))
                    <a href="{{ route('chapitres.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>

        @if($chapitres->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="{{ route('chapitres.index', ['sort' => 'titre', 'direction' => $sortField === 'titre' && $sortDirection === 'asc' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}" class="text-decoration-none text-dark">
                                    Titre
                                    @if($sortField === 'titre')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            @if(!isset($matiere))
                                <th>Matière</th>
                            @endif
                            <th>
                                <a href="{{ route('chapitres.index', ['sort' => 'created_at', 'direction' => $sortField === 'created_at' && $sortDirection === 'asc' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}" class="text-decoration-none text-dark">
                                    Date de création
                                    @if($sortField === 'created_at')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chapitres as $chapitre)
                            <tr>
                                <td>{{ $chapitre->titre }}</td>
                                @if(!isset($matiere))
                                    <td>
                                        <a href="{{ route('matieres.show', $chapitre->matiere) }}">
                                            {{ $chapitre->matiere->nom_matiere }}
                                        </a>
                                        <span class="badge bg-secondary">{{ $chapitre->matiere->niveau }}</span>
                                    </td>
                                @endif
                                <td>{{ $chapitre->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('chapitres.show', $chapitre) }}" class="btn btn-sm btn-info text-white btn-action" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('chapitres.edit', $chapitre) }}" class="btn btn-sm btn-warning text-white btn-action" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('chapitres.destroy', $chapitre) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce chapitre ?');">
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
                {{ $chapitres->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>Aucun chapitre trouvé.
            </div>
        @endif
    </div>
</div>
@endsection