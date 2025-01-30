<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/editeur/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/dashboard/editeur/board" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Accueil</span>
                </a>
            </div>
            <nav class="sidebar-nav">
                <a href="/dashboard/editeur/magazin" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span>Numéros du Magazine</span>
                </a>
                <a href="/dashboard/editeur/manage/users" class="nav-link active">
                    <i class="fas fa-users"></i>
                    <span>Gérer les Utilisateurs</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <div class="header-content">
                    <h1>Gérer les Utilisateurs</h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-plus"></i> Ajouter un Utilisateur
                    </button>
                </div>
            </header>

            <div class="content-wrapper">
                <div class="tabs-container">
                    <ul class="nav nav-tabs custom-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#subscribers">
                                Abonnés
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#managers">
                                Responsables de Thèmes
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                      <!-- Alert Messages -->
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="tab-pane fade show active" id="subscribers">
                            <div class="table-card">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Date d'Inscription</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($usersAbonne as $user)
                                                <tr>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ optional($user->themeSubscriptions->first())->subscription_date ? $user->themeSubscriptions->first()->subscription_date->format('d/m/Y') : 'N/A' }}</td>
                                                    <td><span class="badge bg-success">{{ $user->status }}</span></td>
                                                    <td class="actions">
                                                        <button class="btn btn-icon" title="Modifier" data-bs-toggle="modal" data-bs-target="#editAbonneModal{{ $user->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-icon" title="Bloquer" data-bs-toggle="modal" data-bs-target="#blockUserModal{{$user->id}}">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                        <button class="btn btn-icon" title="Supprimer" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$user->id}}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                    {{-- update modale abonne --}}
                                                <div class="modal fade" id="editAbonneModal{{ $user->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modifier l'Utilisateur</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form class="custom-form" action="/dashboard/editeur/manage/users/update/{{ $user->id }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="userName">Nom</label>
                                                                        <input type="text" class="form-control mb-2" name="username" id="userName" value="{{ $user->username }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fullName">Full Name</label>
                                                                        <input type="text" class="form-control mb-2" name="full_name" id="fullName" value="{{ $user->full_name }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="userEmail">Email</label>
                                                                        <input type="email" class="form-control mb-2" id="userEmail" name="email" value="{{ $user->email }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="userType">Type d'Utilisateur</label>
                                                                        <select class="form-control mb-2 user-type" name="role" id="userType" data-theme-field="themeField" required>
                                                                            <option value="abonne" {{ $user->role == 'abonne' ? 'selected' : '' }}>Abonné</option>
                                                                            <option value="responsable" {{ $user->role == 'responsable' ? 'selected' : '' }}>Responsable de Thème</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group theme-field" id="themeField" style="{{ $user->role == 'responsable' ? 'display:none;' : '' }}">
                                                                        <label for="userTheme">Thème</label>
                                                                        <select name="theme" class="form-control mb-2" id="userTheme">
                                                                            @foreach($allThemes as $theme)
                                                                                <option value="{{ $theme->id }}" {{ $user->theme_id == $theme->id ? 'selected' : '' }}>
                                                                                    {{ $theme->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <!-- Block User Confirmation Modal -->
                                                <div class="modal fade" id="blockUserModal{{$user->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirmer le Blocage</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Êtes-vous sûr de vouloir bloquer l'utilisateur <span id="blockUserName"></span> ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <a href="/dashboard/editeur/manage/users/bloque/{{$user->id}}" class="btn btn-danger">Confirmer</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                   <!-- Delete User Confirmation Modal -->
                                                <div class="modal fade" id="deleteUserModal{{$user->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirmer la Suppression</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Êtes-vous sûr de vouloir supprimer définitivement l'utilisateur <span id="deleteUserName"></span> ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <form action="/dashboard/editeur/manage/users/delete/{{$user->id}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="managers">
                            <div class="table-card">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Thème</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($usersResponable as $user)
                                                <tr>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ optional($user->themeSubscriptions->first()->theme)->name ?? 'N/A' }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $user->status === 'actif' ? 'success' : 'danger' }}">
                                                            {{ ucfirst($user->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="actions">
                                                        <button class="btn btn-icon" title="Modifier" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-icon" title="Bloquer" data-bs-toggle="modal" data-bs-target="#blockUserModal{{$user->id}}">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                        <button class="btn btn-icon" title="Supprimer" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$user->id}}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                {{-- update modale responsable--}}
                                                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modifier l'Utilisateur</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form class="custom-form" action="/dashboard/editeur/manage/users/update/{{ $user->id }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="userName">Nom</label>
                                                                        <input type="text" class="form-control mb-2" name="username" id="userName" value="{{ $user->username }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fullName">Full Name</label>
                                                                        <input type="text" class="form-control mb-2" name="full_name" id="fullName" value="{{ $user->full_name }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="userEmail">Email</label>
                                                                        <input type="email" class="form-control mb-2" id="userEmail" name="email" value="{{ $user->email }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="userType">Type d'Utilisateur</label>
                                                                        <select class="form-control mb-2 user-type" name="role" id="userType" data-theme-field="themeField" required>
                                                                            <option value="abonne" {{ $user->role == 'abonne' ? 'selected' : '' }}>Abonné</option>
                                                                            <option value="responsable" {{ $user->role == 'responsable' ? 'selected' : '' }}>Responsable de Thème</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group theme-field" id="themeField" style="{{ $user->role == 'responsable' ? 'display:none;' : '' }}">
                                                                        <label for="userTheme">Thème</label>
                                                                        <select name="theme" class="form-control mb-2" id="userTheme">
                                                                            @foreach($allThemes as $theme)
                                                                                <option value="{{ $theme->id }}" {{ $user->theme_id == $theme->id ? 'selected' : '' }}>
                                                                                    {{ $theme->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                                       <!-- Block User Confirmation Modal -->
                                                <div class="modal fade" id="blockUserModal{{$user->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirmer le Blocage</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Êtes-vous sûr de vouloir bloquer l'utilisateur <span id="blockUserName"></span> ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <a href="/dashboard/editeur/manage/users/bloque/{{$user->id}}" class="btn btn-danger">Confirmer</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                   <!-- Delete User Confirmation Modal -->
                                                <div class="modal fade" id="deleteUserModal{{$user->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirmer la Suppression</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Êtes-vous sûr de vouloir supprimer définitivement l'utilisateur <span id="deleteUserName"></span> ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <form action="/dashboard/editeur/manage/users/delete/{{$user->id}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un Nouvel Utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form class="custom-form" action="/dashboard/editeur/manage/users/create" method="POST">
                    @csrf
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="userName">Nom</label>
                                <input type="text" class="form-control" name="username" id="userName" required>
                            </div>
                            <div class="form-group">
                                <label for="userName">full name</label>
                                <input type="text" class="form-control" name="full_name" id="fullName" required>
                            </div>
                            <div class="form-group">
                                <label for="userEmail">Email</label>
                                <input type="email" class="form-control" id="userEmail" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="userType">Type d'Utilisateur</label>
                                <select class="form-control" name="role"id="userType" required>
                                    <option value="abonne">Abonné</option>
                                    <option value="responsable">Responsable de Thème</option>
                                </select>
                            </div>
                            <div class="form-group" id="themeField">
                                <label for="userTheme">Thème</label>
                                <select name="theme" class="form-control" id="userTheme">
                                    @foreach($allThemes as $theme)
                                        <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var userType = document.getElementById("userType");
            var themeField = document.getElementById("themeField");

            function toggleThemeField() {
                if (userType.value === "responsable") {
                    themeField.style.display = "none";
                } else {
                    themeField.style.display = "block";
                }
            }

            userType.addEventListener("change", toggleThemeField);

            // Initialiser au chargement de la page
            toggleThemeField();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

