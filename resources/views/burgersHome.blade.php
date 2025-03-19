<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Gestionnaire</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background:rgb(255, 219, 219);
            font-family: 'Arial', sans-serif;
            background: url('{{ asset("images/gestlogo.png") }}') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #990404, rgb(154, 40, 40));
            color: white;
            padding: 35px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            border-bottom: 4px solid #770303;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            flex-grow: 1;
            text-align: center;
        }

        .logout-btn {
    position: absolute;
    right: 40px; /* Augmenté pour pousser le bouton vers la gauche */
    background-color: white;
    color: #990404;
    border: none;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 5px;
    transition: 0.3s;
}


        .logout-btn:hover {
            background-color: #d13b3b;
            color: white;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 80px;
            padding: 20px;
            border-radius: 15px;
            width: 70%;
            max-width: 800px;
            background: rgba(255, 211, 186, 0.8);
        }

        .profile-section {
            text-align: center;
            margin-bottom: 15px;
        }

        .profile-img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #990404;
        }

        .welcome-message {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .nav-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px 80px;
            width: 100%;
            max-width: 500px;
        }

        .nav-buttons a {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #990404;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-align: center;
            width: 100%;
        }

        .nav-buttons a:hover {
            background-color: #d13b3b;
            transform: translateY(-3px);
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 14px;
        }

        .bonjour {
    color: #990404; /* Même couleur que les boutons */
}

    </style>
</head>
<body style="background-color: black;">
    <div class="overlay"></div>
    
    <header>
        <h1>Bienvenue dans l'interface Gestionnaire</h1>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</button>

    </header>

    <div class="content">
        <div class="profile-section">
            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Image de profil" class="profile-img">
            <p class="welcome-message"><span class="bonjour">Bonjour,</span> {{ Auth::user()->name }} !</p>

        </div>

        <div class="nav-buttons">
        <a href="{{ route('AfficherBurgers.home') }}">Afficher des Burgers</a>
        <a href="{{ route('Ajouterburgers.home') }}">Ajouter des Burgers</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 ISI BURGER. Tous droits réservés.</p>
    </footer>
</body>
</html>
