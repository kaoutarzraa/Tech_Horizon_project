<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord du Magazine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/editeur/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/dashboard/editeur/board" class="nav-link active">
                    <i class="fas fa-home"></i>
                    <span>Accueil</span>
                </a>
            </div>
            <nav class="sidebar-nav">
                <a href="/dashboard/editeur/magazin" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span>Numéros du Magazine</span>
                </a>
                <a href="/dashboard/editeur/manage/users" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Gérer les Utilisateurs</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Tableau de Bord</h1>
            </header>

            <div class="content-wrapper">
                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Numéros du Magazine</h3>
                        <div class="stat-value">24</div>
                        <a href="/dashboard/editeur/magazin" class="btn btn-primary">GÉRER</a>
                    </div>

                    <div class="stat-card">
                        <h3>Abonnés</h3>
                        <div class="stat-value">{{$abonneCount}}</div>
                        <a href="/dashboard/editeur/manage/users" class="btn btn-primary">GÉRER</a>
                    </div>

                    <div class="stat-card">
                        <h3>Responsables de Thèmes</h3>
                        <div class="stat-value">{{$responsableCount}}</div>
                        <a href="/dashboard/editeur/manage/users" class="btn btn-primary">GÉRER</a>
                    </div>

                    <div class="stat-card">
                        <h3>Articles</h3>
                        <div class="stat-value">{{$articleCount}}</div>
                        <button class="btn btn-primary">VOIR STATS</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

