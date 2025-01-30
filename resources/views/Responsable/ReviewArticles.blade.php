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
                <div class="messages-container">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>

                <!-- Review Articles Section -->
                <section id="review-articles">
                    <h2>Review Articles</h2>
                    <div class="card">
                        <div class="card-body">
                            <p>Review and approve or reject submitted articles.</p>
                            <ul class="list-group">
                                @foreach($articles as $article)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $article->title }} - Submitted on {{ $article->submission_date }}
                                    <div>
                                        <button class="btn btn-success btn-sm publish-btn" data-bs-toggle="modal" data-bs-target="#publishModal{{ $article->id }}" data-article-id="{{ $article->id }}" data-article-title="{{ $article->title }}">Publish</button>
                                        <button class="btn btn-danger btn-sm reject-btn" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $article->id }}" data-article-id="{{ $article->id }}" data-article-title="{{ $article->title }}">Reject</button>
                                    </div>
                                </li>
                                    <!-- Publish Confirmation Modal -->
                                <div class="modal fade" id="publishModal{{ $article->id }}" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="publishModalLabel">Publish Article</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to publish the article "<span id="publishArticleTitle">{{ $article->title }}</span>"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="publishArticle/{{ $article->id }}">
                                                    <button type="button" class="btn btn-success" id="confirmPublish">Publish</button>
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
                                                <h5 class="modal-title" id="rejectModalLabel">Reject Article</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to reject the article "<span id="rejectArticleTitle">{{ $article->title }}</span>"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="rejectArticle/{{ $article->id }}">
                                                    <button type="button" class="btn btn-danger" id="confirmReject">Reject</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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