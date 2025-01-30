<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Mes Articles</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Keep existing styles up to .themes-grid */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
        }

        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .main-nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4a5568;
            text-decoration: none;
        }

        .main-nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .main-nav a {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .dashboard-container {
            display: flex;
            margin-top: 60px;
            min-height: calc(100vh - 60px);
        }

        .sidebar {
            width: 280px;
            background: white;
            padding: 2rem 0;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            padding: 1rem 2rem;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-nav li a.active {
            background: #ebf4ff;
            color: #667eea;
            border-right: 3px solid #667eea;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            background: #f8fafc;
        }

        /* New and modified styles for article cards */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            padding: 1rem;
        }

        .article-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .article-card:hover {
            transform: translateY(-5px);
        }

        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .article-content {
            padding: 1.5rem;
        }

        .article-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .article-theme {
            color: #667eea;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .article-preview {
            color: #718096;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .article-status {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .article-date {
            color: #718096;
            font-size: 0.75rem;
        }

        @media (max-width: 1400px) {
            .articles-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1100px) {
            .articles-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
            }

            .articles-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="main-nav">
            <div class="logo">Tech Horizon</div>
            <ul>
                <li><a href="/home">Accueil</a></li>
                <li><a href="/Logout">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <div class="dashboard-container">
        <aside class="sidebar">
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="#">Visualiser les Numéros</a></li>
                    <li><a href="/subscriptions">Gérer les Abonnements</a></li>
                    <li><a href="#">Historique de Navigation</a></li>
                    <li><a href="/manageArticles/bySubscriber" class="active">Mes Articles</a></li>
                    <li><a href="#">Mes Notes</a></li>
                    <li><a href="#">Discussions</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <h1 class="page-title">Mes Articles</h1>
            
            <!-- Add New Article Button -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                Ajouter un Nouvel Article
            </button>

            <!-- Rest of your content -->
            <div class="messages-container">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            <div class="articles-grid">
                @foreach ($articles as $article)
                <div class="article-card">
                    <img src="{{ $article->image_url ?? '/placeholder-image.jpg' }}" alt="{{ $article->title }}" class="article-image">
                    <div class="article-content">
                        <div class="article-theme">{{ $article->theme->name }}</div>
                        <h3 class="article-title">{{ $article->title }}</h3>
                        <p class="article-preview">{{ $article->content }}</p>
                        <div class="article-footer">
                            <span class="article-status {{ $article->status == 'En cours' ? 'status-pending' : 'status-published' }}">
                                {{ $article->status }}
                            </span>
                        </div>
                    </div>
                    <div class="article-footer">
                        <div>
                            <!-- Update Button -->
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateArticleModal{{ $article->id }}">
                                Modifier
                            </button>
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteArticleModal{{ $article->id }}">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
                                
                <div class="modal fade" id="updateArticleModal{{ $article->id }}" tabindex="-1" aria-labelledby="updateArticleModalLabel{{ $article->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateArticleModalLabel{{ $article->id }}">Modifier l'article</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/manageArticles/bySubscriber/update/{{$article->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="title{{ $article->id }}" class="form-label">Titre</label>
                                        <input type="text" class="form-control" id="title{{ $article->id }}" name="title" value="{{ $article->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content{{ $article->id }}" class="form-label">Contenu</label>
                                        <textarea class="form-control" id="content{{ $article->id }}" name="content" rows="5" required>{{ $article->content }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image{{ $article->id }}" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image{{ $article->id }}" name="image">
                                        @if ($article->image_url)
                                            <img src="{{ $article->image_url }}" alt="Current Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="theme_id{{ $article->id }}" class="form-label">Thème</label>
                                        <select class="form-select" id="theme_id{{ $article->id }}" name="theme_id" required>
                                            @foreach($themes as $theme)
                                                <option value="{{ $theme->id }}" {{ $article->theme_id == $theme->id ? 'selected' : '' }}>{{ $theme->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="issue_id{{ $article->id }}" class="form-label">Numéro</label>
                                        <select class="form-select" id="issue_id{{ $article->id }}" name="issue_id" >
                                            @foreach($issues as $issue)
                                                <option value="{{ $issue->id }}" {{ $article->issue_id == $issue->id ? 'selected' : '' }}>{{ $issue->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteArticleModal{{ $article->id }}" tabindex="-1" aria-labelledby="deleteArticleModalLabel{{ $article->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteArticleModalLabel{{ $article->id }}">Supprimer l'article</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer cet article : <strong>{{ $article->title }}</strong> ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form action="/manageArticles/bySubscriber/delete/{{$article->id}}" method="POST">
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
        </main>
                <!-- Add Article Modal -->
        <div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addArticleModalLabel">Ajouter un Nouvel Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/manageArticles/bySubscriber/create" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Contenu</label>
                                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="theme_id" class="form-label">Thème</label>
                                <select class="form-select" id="theme_id" name="theme_id" required>
                                    <option value="">Sélectionnez un thème</option>
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="issue_id" class="form-label">Numéro</label>
                                <select class="form-select" id="issue_id" name="issue_id">
                                    <option value="">Sélectionnez un numéro</option>
                                    @foreach($issues as $issue)
                                        <option value="{{ $issue->id }}">{{ $issue->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

