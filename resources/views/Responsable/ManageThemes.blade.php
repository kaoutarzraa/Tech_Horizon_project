<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Thèmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Improved Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            position: sticky;
            top: 0;
            height: 100%;
        }

        .sidebar h3 {
            color: #ecf0f1;
            font-size: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #34495e;
            margin-bottom: 1.5rem;
        }

        .sidebar .nav-link {
            color: #bdc3c7;
            padding: 0.8rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: #34495e;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: #3498db;
            color: white;
        }

        /* Improved Content Area */
        .content {
            padding: 30px;
            min-height: 100vh;
        }

        /* Improved Theme Cards */
        .theme-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .theme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .theme-card .card-body {
            padding: 1.5rem;
        }

        .theme-card .card-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .theme-card .card-text {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
            min-height: 48px;
        }

        /* Button Styling */
        .btn-add-theme {
            padding: 0.8rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .theme-card .btn {
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            border-radius: 6px;
        }

        /* Card Button Container */
        .card-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: start;
        }

        /* Modal Improvements */
        .modal-content {
            border-radius: 12px;
            border: none;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            border-radius: 12px 12px 0 0;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
            background-color: #f8f9fa;
            border-radius: 0 0 12px 12px;
        }

        /* Alert Styling */
        .alert {
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        /* Responsive Grid */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1000;
                width: 100%;
                min-height: auto;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .theme-card {
                margin-bottom: 1rem;
            }
        }

        /* Theme Grid Layout */
        .themes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <h3>Gestion des Thèmes</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard/responsable/themes">
                            <i class="fas fa-th-large me-2"></i>Tous les Thèmes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/responsable/reviewArticles">
                            <i class="fas fa-check-circle me-2"></i>Réviser les Articles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/responsable/statistics">
                            <i class="fas fa-chart-bar me-2"></i>Voir les Statistiques
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#discussions">
                            <i class="fas fa-comments me-2"></i>Modérer les Discussions
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 content">
                <!-- Add New Theme Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Tous les Thèmes</h2>
                    <button type="button" class="btn btn-primary btn-add-theme" data-bs-toggle="modal" data-bs-target="#addThemeModal">
                        <i class="fas fa-plus me-2"></i>Ajouter un Nouveau Thème
                    </button>
                </div>

                <!-- Alert Messages -->
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Themes Grid -->
                <div class="themes-grid">
                    @foreach($themes as $theme)
                    <div class="theme-card-wrapper">
                        <div class="card theme-card">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $theme->name }}</h5>
                                <p class="card-text flex-grow-1">{{ $theme->description }}</p>
                                <div class="card-buttons">
                                    <a href="subscriptions/{{$theme->id}}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-users me-1"></i> Gérer les abonnements
                                    </a>
                                    <a href="superviseArticles/{{$theme->id}}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-file-alt me-1"></i> Articles
                                    </a>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateThemeModal{{$theme->id}}">
                                        <i class="fas fa-edit me-1"></i> Modifier
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteThemeModal{{$theme->id}}">
                                        <i class="fas fa-trash me-1"></i> Supprimer
                                    </button>
                            </div>
                        </div>
                    </div>
                                                <!-- Update Theme Modal -->
                        <div class="modal fade" id="updateThemeModal{{$theme->id}}" tabindex="-1" aria-labelledby="updateThemeModalLabel{{$theme->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateThemeModalLabel{{$theme->id}}">Mettre à jour le thème</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/dashboard/responsable/themes/update/{{$theme->id}}" method= "POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="themeName{{$theme->id}}" class="form-label">Nom</label>
                                                    <input type="text" name="name" class="form-control" id="themeName{{$theme->id}}" value="{{$theme->name}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="themeDescription{{$theme->id}}" class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" id="themeDescription{{$theme->id}}">{{$theme->description}}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="themeImage{{$theme->id}}" class="form-label">Télécharger l'image</label>
                                                    <input type="file" class="form-control" name="image" id="themeImage{{$theme->id}}">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Theme Modal -->
                        <div class="modal fade" id="deleteThemeModal{{$theme->id}}" tabindex="-1" aria-labelledby="deleteThemeModalLabel{{$theme->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteThemeModalLabel{{$theme->id}}">Supprimer le thème</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer ce thème?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="/dashboard/responsable/themes/delete/{{$theme->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
   <!-- Add Theme Modal -->
    <div class="modal fade" id="addThemeModal" tabindex="-1" aria-labelledby="addThemeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addThemeModalLabel">Add New Theme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/dashboard/responsable/themes/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                            <div class="mb-3">
                                <label for="themeName" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="themeName">
                            </div>
                            <div class="mb-3">
                                <label for="themeDescription" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="themeDescription"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="themeImage" class="form-label">Upload Image</label>
                                <input type="file" name="image" class="form-control" id="themeImage">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
    <script>
        // Add active class to current nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });

        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        }
    </script>
</body>
</html>