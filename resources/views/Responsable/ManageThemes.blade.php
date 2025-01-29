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
        .theme-card {
            cursor: pointer;
            transition: transform 0.2s;
        }
        .theme-card:hover {
            transform: scale(1.02);
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
                <!-- Display All Themes Section -->
                <section id="themes">
                    <h2>All Themes</h2>
                    <div class="row">
                        <!-- Theme 1 -->
                        @foreach($themes as $theme)
                            <div class="col-md-4">
                                <div class="card theme-card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $theme->title }}</h5>
                                        <p class="card-text">{{ $theme->description }}</p>
                                        <a href="subscriptions/{{$theme->id}}" class="btn btn-primary btn-sm">Manage Subscriptions</a>
                                        <a href="superviseArticles/{{$theme->id}}" class="btn btn-secondary btn-sm">Supervise Articles</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>