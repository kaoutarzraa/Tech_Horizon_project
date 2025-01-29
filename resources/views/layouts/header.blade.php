    <header>
        <nav>
            <div class="logo">Tech Horizon</div>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">AI</a></li>
                <li><a href="#">IoT</a></li>
                <li><a href="#">Cybersécurité</a></li>
                <li><a href="#">Réalité Virtuelle</a></li>

                <li><a href="/subscriptions">S'abonner</a></li>

                @auth
                    @if(Auth::user()->role == 'responsable')
                        <li><a href="/dashboard/responsable/themes">Dashboard Responsable</a></li>
                    @endif
                @endauth


            </ul>
        </nav>
    </header>