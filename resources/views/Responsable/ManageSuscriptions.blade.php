<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des abonnements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
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

        /* Content Area */
        .content {
            padding: 30px;
            min-height: 100vh;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #2c3e50;
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #2c3e50;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Button Styling */
        .btn-danger {
            background-color: #e74c3c;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
        }

        /* Section Header */
        h2 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        /* Responsive Design */
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

            .table-responsive {
                margin: 0;
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
                        <a class="nav-link" href="/dashboard/responsable/reviewArticles">
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
                <!-- Manage Subscriptions Section -->
                <section id="subscriptions">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Gérer les Abonnements</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <p class="text-muted mb-4">Voir et gérer tous les abonnements pour votre thème.</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Abonné</th>
                                            <th>Email</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscriptions as $subscription)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2">
                                                        <h6 class="mb-0">{{ $subscription->user->username }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $subscription->user->email }}</td>
                                            <td>
                                                <span class="badge bg-success">Actif</span>
                                            </td>
                                            <td>
                                                <a href="/subscription/changeStatusToExpire/{{$subscription->theme->id}}" 
                                                   class="btn btn-danger btn-sm">
                                                    <i class="fas fa-user-times me-1"></i>
                                                    Se désabonner
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
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