<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>
<body>
    <h1>Page d'inscription</h1>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire d'inscription -->
    <form action="{{ route('auth.register.post') }}" method="POST">
        @csrf <!-- Protection CSRF obligatoire -->

        <!-- Nom -->
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <!-- Email -->
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <!-- Mot de passe -->
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <!-- Confirmation du mot de passe -->
        <label for="password_confirmation">Confirmez le mot de passe :</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <!-- Bouton S'inscrire -->
        <button type="submit">Sign up</button>
    </form>
</body>
</html>
