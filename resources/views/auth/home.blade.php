<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizon - Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #2d3748;
            line-height: 1.6;
        }

        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4a5568;
            text-decoration: none;
        }

        nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        nav a {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #667eea;
        }

        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8rem 2rem 4rem;
            text-align: center;
            margin-top: 60px;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .cta-button {
            display: inline-block;
            background-color: #fff;
            color: #667eea;
            padding: 1rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .themes-info {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .themes-info h2 {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2rem;
            color: #2d3748;
        }

        .themes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .theme {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .theme:hover {
            transform: translateY(-5px);
        }

        .theme button {
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
            padding: 0;
            text-align: left;
        }

        .theme img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .theme h3 {
            padding: 1.5rem 1.5rem 0.5rem;
            font-size: 1.25rem;
            color: #2d3748;
        }

        .theme p {
            padding: 0 1.5rem 1.5rem;
            color: #718096;
        }

        .footer {
            background-color: #2d3748;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                padding: 1rem;
            }

            nav ul {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
                margin-top: 1rem;
            }

            .hero {
                padding: 6rem 1rem 3rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .themes-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

 @include('../layouts.header')

    <section class="hero">
        <h1>Explorez le Futur de la Technologie</h1>
        <p>Découvrez des articles de qualité sur l'IA, la Blockchain, la cybersécurité et bien plus encore.</p>
        <a href="#" class="cta-button">Devenir Abonné</a>
    </section>

    <section class="themes-info">
        <h2>Nos Thèmes</h2>
        <div class="themes-grid">

            @foreach ($themes as $theme)
                <div class="theme">
                    <button onclick="window.location.href='/getArticles/byThemeId/{{ $theme['id'] }}';">
                    <img src="{{ asset('storage/' . $theme['image_url']) }}" alt="{{ $theme['title'] }}">
                        <h3>{{ $theme['title'] }}</h3>
                        <p>{{ $theme['description'] }}</p>
                    </button>
                </div>
            @endforeach
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2025 Tech Horizon</p>
    </footer>
</body>
</html>