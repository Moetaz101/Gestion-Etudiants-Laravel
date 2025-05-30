<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ActeurAdmin - Gestion des Étudiants</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            padding-top: 20px;
        }
        .success-message {
            animation: fadeOut 5s forwards;
            animation-delay: 3s;
        }
        @keyframes fadeOut {
            from {opacity: 1;}
            to {opacity: 0; display: none;}
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="mb-4">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('etudiants.index') }}">
                        <i class="fas fa-user-graduate me-2"></i>ActeurAdmin
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('etudiants.index') ? 'active' : '' }}" href="{{ route('etudiants.index') }}">
                                    <i class="fas fa-list me-1"></i>Liste des étudiants
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('etudiants.create') ? 'active' : '' }}" href="{{ route('etudiants.create') }}">
                                    <i class="fas fa-plus me-1"></i>Ajouter un étudiant
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
        @if(session('success'))
            <div class="alert alert-success success-message">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif
        
        <main>
            @yield('content')
        </main>
        
        <footer class="mt-5 text-center text-muted">
            <hr>
            <p>&copy; {{ date('Y') }} ActeurAdmin - Système de Gestion des Étudiants</p>
        </footer>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>