<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Gestion des Abonnements</title>
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
        }

        .main-nav a {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .main-nav a:hover {
            color: #667eea;
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
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            padding: 1rem 2rem;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-nav li a:hover {
            background: #f7fafc;
            color: #667eea;
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

        .page-title {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: #2d3748;
        }

        .themes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .theme-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .theme-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .theme-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3748;
        }

        .subscription-toggle {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .subscription-toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e0;
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #667eea;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(24px);
        }

        .theme-info {
            color: #718096;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .theme-stats {
            display: flex;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 0.875rem;
        }

        .search-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
        }

        .filter-button {
            padding: 0.75rem 1.5rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #4a5568;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-button:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
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

            .main-nav {
                flex-direction: column;
                padding: 1rem;
            }

            .main-nav ul {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
                margin-top: 1rem;
            }

            .themes-grid {
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
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Mon Profil</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

     

    <div class="dashboard-container">
        <aside class="sidebar">
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="#">Visualiser les Numéros</a></li>
                    <li><a href="#" class="active">Gérer les Abonnements</a></li>
                    <li><a href="#">Historique de Navigation</a></li>
                    <li><a href="/manageArticles/bySubscriber">Proposer un Article</a></li>
                    <li><a href="#">Mes Notes</a></li>
                    <li><a href="#">Discussions</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <h1 class="page-title">Gérer mes Abonnements aux Thèmes</h1>

            <div class="messages-container">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Rechercher un thème...">
                <button class="filter-button">Filtrer</button>
            </div>

            <div class="themes-grid">
                <!-- Theme 1 -->
                @foreach ($subscriptions as $subscription)
                    <div class="theme-card">
                        <div class="theme-header">
                            <h3 class="theme-title">{{ $subscription->theme->name }}</h3>
                            <a href="/subscription/changeStatusToExpire/{{$subscription->theme->id}}">
                            <button class="btn btn-danger">Désabonnement</button>
                            </a>
                        </div>
                        <p class="theme-info">{{ $subscription->theme->description }}</p>
                        <div class="theme-stats">
                            <span>articles/mois</span>
                            <span>abonnés</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</html>