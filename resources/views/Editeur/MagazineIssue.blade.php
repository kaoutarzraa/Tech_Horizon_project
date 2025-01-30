<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Numéros du Magazine</title>
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
                <a href="/dashboard/editeur/magazin" class="nav-link active">
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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Header with create button -->
            <header class="main-header">
                <div class="header-content">
                    <h1>Gérer les Numéros du Magazine</h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i> Ajouter un Numéro
                    </button>
                </div>
            </header>

            <!-- Table remains unchanged but with added data attributes -->
            <div class="content-wrapper">
                <div class="table-card">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <!-- Example row with data attributes -->
                                @foreach($issues as $issue)
                                    <tr>
                                        <td>#{{ $issue->id }}</td>
                                        <td>{{ $issue->title }}</td>
                                        <td>{{ $issue->publication_date }}</td>
                                        <td><span class="badge bg-success">{{ $issue->status }}</span></td>
                                        <td class="actions">
                                            <button class="btn btn-icon btn-edit" title="Modifier" data-bs-toggle="modal" data-bs-target="#updateModal{{ $issue->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-icon" title="Supprimer" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $issue->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="btn btn-icon btn-preview" title="Aperçu" data-bs-toggle="modal" data-bs-target="#previewModal{{ $issue->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Update Modal -->
                                    <div class="modal fade" id="updateModal{{ $issue->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier le Numéro</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="updateForm{{ $issue->id }}"action="/dashboard/editeur/magazin/update/{{$issue->id}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id="editId" value="{{ $issue->id }}">
                                                        <div class="mb-3">
                                                            <label class="form-label">Titre</label>
                                                            <input type="text" name="title" class="form-control" id="editTitle" value="{{ $issue->title }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Image</label>
                                                            <input type="file" name="image" class="form-control" id="editImage" accept="image/*">
                                                            <small class="text-muted">Laisser vide pour conserver l'image actuelle</small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="description" id="editDescription" rows="4" required>{{ $issue->description }}</textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" form="updateForm{{ $issue->id }}" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Preview Modal -->
                                    <div class="modal fade" id="previewModal{{ $issue->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Aperçu du Numéro</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center mb-3">
                                                        <img id="previewImg" src="{{ $issue->image }}" class="img-fluid" style="max-height: 300px;">
                                                    </div>
                                                    <h4 id="previewTitle">{{ $issue->title }}</h4>
                                                    <p id="previewDescription" class="lead">{{ $issue->description }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $issue->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmer la Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Êtes-vous sûr de vouloir supprimer le numéro <strong>{{ $issue->title }}</strong> ? Cette action est irréversible.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="/dashboard/editeur/magazin/delete/{{ $issue->id }}" method="POST">
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
        </main>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Créer un Nouveau Numéro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" >
                    <form id="createForm" action="/dashboard/editeur/magazin/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="4" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" form="createForm" class="btn btn-primary">Créer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>