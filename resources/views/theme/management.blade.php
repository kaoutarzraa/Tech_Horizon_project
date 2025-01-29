<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article - {{ $theme->name }}</title>
</head>
<body>
    <h1>Ajouter un Article pour le Thème : {{ $theme->name }}</h1>

    <form action="{{ route('manager.theme.store', $theme->id) }}" method="POST">
        @csrf
        <label for="title">Titre de l'Article</label>
        <input type="text" id="title" name="title" required>

        <label for="content">Contenu de l'Article</label>
        <textarea id="content" name="content" required></textarea>

        <button type="submit">Ajouter l'Article</button>
    </form>
</body>
</html>