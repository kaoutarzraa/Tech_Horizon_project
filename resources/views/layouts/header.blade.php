    <header>
        <nav>
            <div class="logo">Tech Horizon</div>
            <ul>
                <li><a href="/home">Accueil</a></li>
                @auth
                    @if(Auth::user()->role == 'abonne')
                        <li><a href="/subscriptions">S'abonner</a></li>
                    @endif
                @endauth

                @auth
                    @if(Auth::user()->role == 'responsable')
                        <li><a href="/dashboard/responsable/themes">Dashboard Responsable</a></li>
                    @endif
                @endauth
                
                @auth
                    @if(Auth::user()->role == 'editeur')
                        <li><a href="/dashboard/editeur/board">Dashboard Editeur</a></li>
                    @endif
                @endauth

                <li><a href="/Logout">Logout</a></li>

            </ul>
        </nav>
    </header>