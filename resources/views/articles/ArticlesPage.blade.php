<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Articles</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
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
        }

        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav {
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

        nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        nav a {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #667eea;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8rem 2rem 4rem;
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .article {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        /* Featured Article */
        .article:first-child {
            grid-column: span 12;
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            min-height: 400px;
        }

        .article:first-child .article-image {
            height: 100%;
        }

        .article:first-child .article-content {
            padding: 2rem;
        }

        .article:first-child h2 {
            font-size: 2rem;
        }

        /* Secondary Articles */
        .article:not(:first-child) {
            grid-column: span 6;
        }

        /* Smaller Articles */
        .article:nth-child(4),
        .article:nth-child(5) {
            grid-column: span 4;
        }

        .article:hover {
            transform: translateY(-5px);
        }

        .article-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }

        .article-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .article-meta {
            font-size: 0.9rem;
            color: #718096;
            margin-bottom: 0.5rem;
            display: flex;
            gap: 1rem;
        }

        .article h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #2d3748;
        }

        .article p {
            color: #718096;
            margin-bottom: 1.5rem;
        }

        .read-more {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            margin-top: auto;
            display: inline-flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .read-more:hover {
            color: #764ba2;
        }

        .read-more::after {
            content: '→';
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }

        .read-more:hover::after {
            transform: translateX(5px);
        }

        .category-tag {
            display: inline-block;
            padding: 0.25rem 1rem;
            background-color: #edf2f7;
            color: #4a5568;
            border-radius: 20px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

         .load-more-button:hover {
                    background-color: #764ba2;
                }

        @media (max-width: 1024px) {
            .article:first-child {
                grid-template-columns: 1fr;
            }

            .article:first-child .article-image {
                height: 300px;
            }

            .article:nth-child(4),
            .article:nth-child(5) {
                grid-column: span 6;
            }
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                padding: 1rem;
            }

            nav ul {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
                margin-top: 1rem;
            }

            .articles-grid {
                grid-template-columns: 1fr;
            }

            .article:not(:first-child) {
                grid-column: span 12;
            }

            .article:nth-child(4),
            .article:nth-child(5) {
                grid-column: span 12;
            }
        }
    </style>
</head>
<body>

@include('../layouts.header')

    <div class="page-header">
        <h1>Derniers Articles</h1>
    </div>
     <div class="messages-container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    <div class="container">

        <main class="articles-grid">
            @foreach($articles as $article)
                <article class="article">
                    <img src="{{ $article->image_url }}" alt="{{ $article->category }}" class="article-image">
                    <div class="article-content">
                        <span class="category-tag">{{ $article->category }}</span>
                        <div class="article-meta">
                            <span>Par: {{ $article->author->email }}</span>
                            <span>{{ $article->date }}</span>
                        </div>
                        <h2>{{ $article->title }}</h2>
                        <p>{{ $article->excerpt }}</p>
                        <a href="{{ $article->url }}" class="read-more">Lire l'article</a>
                    </div>
                </article>
            @endforeach
            
            </main>
            </div>

            <div class="load-more-container" style="text-align: center; margin-top: 2rem; margin-bottom: 2rem;" data-bs-toggle="modal" data-bs-target="#loadMoreModal">
                <a href="#" class="load-more-button" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #667eea; color: white; border-radius: 5px; text-decoration: none; font-weight: 500; transition: background-color 0.3s ease;">
                    Charger plus d'articles
                </a>
            </div>

                        <!-- Modal -->
            <div class="modal fade" id="loadMoreModal" tabindex="-1" aria-labelledby="loadMoreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loadMoreModalLabel">Chargement des articles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Des articles supplémentaires seront chargés.</p>
                    <p>Êtes-vous sûr de vouloir vous abonner à ce thème ? Après votre abonnement, tous les articles de ce thème seront chargés.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    
                    <a href="/subscribe/{{$id}}" class="btn btn-primary" style="background-color: #667eea; border-color: #667eea;">Charger plus</a>
                </div>
                </div>
            </div>
            </div>

            
        </main>

       
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</html>