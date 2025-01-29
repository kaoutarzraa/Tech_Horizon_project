<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
        body {
        background-color: #f8f9fa;
            }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }
        .sidebar a:hover {
            color: #f8f9fa;
            background-color: #495057;
            padding: 5px;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <h3>Theme Management</h3>
                <ul class="nav flex-column">
                   <li><a href="/dashboard/responsable/themes">All Themes</a></li>
                    <li><a href="#subscriptions">Manage Subscriptions</a></li>
                    <li><a href="#articles">Supervise Articles</a></li>
                    <li><a href="/dashboard/responsable/reviewArticles">Review Articles</a></li>
                    <li><a href="#statistics">View Statistics</a></li>
                    <li><a href="#discussions">Moderate Discussions</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 content">


                <!-- Supervise Articles Section -->
                <section id="articles">
                    <h2>Supervise Articles</h2>
                    <div class="card">
                        <div class="card-body">
                            <p>View all published articles in your theme.</p>
                            <ul class="list-group">
                                @foreach($articles as $article)
                                    <li class="list-group-item">{{ $article->title }} - Published on {{ $article->publication_date }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>