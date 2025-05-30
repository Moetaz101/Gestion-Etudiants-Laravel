<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Évaluations - @yield('title', 'ActeurEnseignant')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .table th {
            cursor: pointer;
        }
        .sort-icon {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('evaluations.index') }}">
                <i class="fas fa-graduation-cap me-2"></i>ActeurEnseignant
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('evaluations.index') ? 'active' : '' }}" href="{{ route('evaluations.index') }}">
                            <i class="fas fa-list me-1"></i>Liste des évaluations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('evaluations.create') ? 'active' : '' }}" href="{{ route('evaluations.create') }}">
                            <i class="fas fa-plus me-1"></i>Ajouter une évaluation
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container">
        <!-- Messages d'alerte (succès, erreur, etc.) -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <!-- Titre de la page -->
        <h1 class="mb-4">@yield('page-title')</h1>

        <!-- Contenu spécifique à chaque page -->
        @yield('content')
    </main>

    <!-- Pied de page -->
    <footer class="mt-5 py-3 bg-light text-center">
        <div class="container">
            <p class="text-muted mb-0">&copy; {{ date('Y') }} ActeurEnseignant - Système de gestion des évaluations</p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>