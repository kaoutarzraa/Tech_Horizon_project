<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revoir les articles</title>
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

        /* Improved Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .card .card-body {
            padding: 1.5rem;
        }

        .card .card-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .card .card-text {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
            min-height: 48px;
        }

        /* Button Styling */
        .btn {
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            border-radius: 6px;
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
                        <a class="nav-link" href="/dashboard/responsable/themes">
                            <i class="fas fa-th-large me-2"></i>Tous les Thèmes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard/responsable/reviewArticles">
                            <i class="fas fa-check-circle me-2"></i>Revoir les Articles
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
                <!-- Alert Messages -->
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Review Articles Section -->
                <h2>Revoir les Articles</h2>
                <div class="card">
                    <div class="card-body">
                        <p>Revoir et approuver ou rejeter les articles soumis.</p>
                        <ul class="list-group">
                            @foreach($articles as $article)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $article->title }} - Soumis le {{ $article->submission_date }}
                                <div>
                                    <button class="btn btn-success btn-sm publish-btn" data-bs-toggle="modal" data-bs-target="#publishModal{{ $article->id }}" data-article-id="{{ $article->id }}" data-article-title="{{ $article->title }}">Publier</button>
                                    <button class="btn btn-danger btn-sm reject-btn" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $article->id }}" data-article-id="{{ $article->id }}" data-article-title="{{ $article->title }}">Rejeter</button>
                                </div>
                            </li>

                            <!-- Publish Confirmation Modal -->
                            <div class="modal fade" id="publishModal{{ $article->id }}" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="publishModalLabel">Publier l'article</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir publier l'article "<span id="publishArticleTitle">{{ $article->title }}</span>"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="publishArticle/{{ $article->id }}">
                                                <button type="button" class="btn btn-success" id="confirmPublish">Publier</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reject Confirmation Modal -->
                            <div class="modal fade" id="rejectModal{{ $article->id }}" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel">Rejeter l'article</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir rejeter l'article "<span id="rejectArticleTitle">{{ $article->title }}</span>"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="rejectArticle/{{ $article->id }}">
                                                <button type="button" class="btn btn-danger" id="confirmReject">Rejeter</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
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