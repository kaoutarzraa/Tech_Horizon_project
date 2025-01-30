<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Jost', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
        }

        .container {
            width: 380px;
            padding: 40px 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #fff;
            font-size: 2em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .logo p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1em;
        }

        .error {
            background: rgba(255, 87, 87, 0.1);
            border-left: 4px solid #ff5757;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: none;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            position: relative;
        }

        label {
            color: #fff;
            font-size: 1em;
            margin-bottom: 8px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #fff;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: rgba(255, 255, 255, 0.5);
            outline: none;
            background: rgba(255, 255, 255, 0.15);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        button {
            background: #fff;
            color: #302b63;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                width: 90%;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>Bienvenue</h1>
            <p>Connectez-vous à votre compte</p>
        </div>

        <div class="error" id="error-messages">
            Les identifiants sont incorrects
        </div>

        <form id="login-form" method="POST" action="{{ route('login.post') }}">
        @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Entrez votre email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Entrez votre mot de passe"
                    required
                >
            </div>

            <button type="submit">Se connecter</button>
        </form>

        <div class="footer">
            Pas encore de compte ? <a href="/">S'inscrire</a>
        </div>
    </div>
</body>
</html>