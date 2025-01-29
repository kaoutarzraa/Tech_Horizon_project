<!-- resources/views/subscription/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'abonner - Tech Horizon</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Tech Horizon</div>
            <ul>
                <li><a href="{{ route('invite') }}">Accueil</a></li>
                <li><a href="{{ route('theme.show', ['id' => 1]) }}">AI</a></li>
                <li><a href="{{ route('theme.show', ['id' => 2]) }}">IoT</a></li>
                <li><a href="{{ route('theme.show', ['id' => 3]) }}">Cybersécurité</a></li>
                <li><a href="{{ route('theme.show', ['id' => 4]) }}">Réalité Virtuelle</a></li>
                <li><a href="{{ route('subscribe') }}">S'abonner</a></li>
            </ul>
        </nav>
    </header>

    <section class="subscription">
        <h1>Devenir Abonné</h1>
        <p>Abonnez-vous pour accéder à du contenu exclusif.</p>
        <!-- Formulaire d'abonnement ici -->
    </section>

    <footer class="footer">
        <p>&copy; 2025 Tech Horizon</p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>