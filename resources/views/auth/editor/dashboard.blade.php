<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Dashboard de l'Éditeur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="dashboard-title">Dashboard de l'Éditeur</h1>

        <!-- Gestion des articles -->
        <h2 class="section-title">Gestion des articles</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->status }}</td>
                        <td>
                            @if($article->status != 'publie')
                                <form action="{{ route('editor.publishArticle', $article->article_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Publier</button>
                                </form>
                            @endif
                            <form action="{{ route('editor.makePublicArticle', $article->article_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Rendre Public</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Gestion des utilisateurs -->
        <h2 class="section-title">Gestion des utilisateurs</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('editor.modifyUser', $user->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('editor.deleteUser', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Statistiques -->
        <h2 class="section-title">Statistiques</h2>
        <ul class="stats-list">
            <li>Nombre d'articles : {{ $stats['numArticles'] }}</li>
            <li>Nombre d'utilisateurs : {{ $stats['numUsers'] }}</li>
            <li>Nombre de responsables de thèmes : {{ $stats['numThemeManagers'] }}</li>
            <li>Nombre de thèmes : {{ $stats['numThemes'] }}</li>
        </ul>
    </div>

    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Container for the page */
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Dashboard title */
        .dashboard-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Section titles */
        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        /* Buttons */
        .btn {
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* Stats List */
        .stats-list {
            list-style-type: none;
            padding: 0;
        }

        .stats-list li {
            font-size: 16px;
            margin-bottom: 8px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
            .table {
                font-size: 14px;
            }
            .stats-list li {
                font-size: 14px;
            }
        }
    </style>
</body>
</html>