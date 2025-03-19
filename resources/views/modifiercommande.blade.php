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
    background: rgb(255, 219, 219);
    font-family: 'Arial', sans-serif;
    background: url('{{ asset("images/gestlogo.png") }}') no-repeat center center;
    background-size: cover;
    background-attachment: fixed; /* Empêche l'image de bouger au défilement */
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
            right: 40px;
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
    justify-content: flex-start; 
    margin-top: 80px;
    padding: 20px;
    border-radius: 15px;
    width: 80%;  
    max-width: 1000px;
    background: rgba(255, 211, 186, 0.8);
    max-height: 70vh; 
    overflow-y: auto; 
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
            color: #990404;
        }

        .burger-list {
            margin-top: 30px;
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white; /* Fond blanc */
            border-radius: 8px;
            margin-top: 20px;
            border: 2px solid #990404; /* Bordure rouge bordeaux */
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-left: 2px solid #990404; /* Bordure rouge bordeaux entre les colonnes */
            border-top: 2px solid #990404; /* Bordure rouge bordeaux entre les colonnes et les lignes */
            color: black; /* Texte des résultats en noir */
        }

        table th {
            background-color: #990404;
            color: white;
        }

        table tr:hover {
            background-color: #f2f2f2;
        }

        table a {
            color: #990404;
            text-decoration: none;
            padding: 5px;
        }

        table a:hover {
            color: white;
        }

        .btn-archiver {
            background-color: #990404;  /* Changer la couleur ici pour le même rouge bordeaux */
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-archiver:hover {
            background-color: #d13b3b;
        }

        .btn-edit, .btn-delete {
            background-color: #990404;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover, .btn-delete:hover {
            background-color: #d13b3b;
        }

        .bonjour/* Conteneur principal */
.container {
    width: 80%;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Titre principal */
h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

/* Formulaire */
form {
    display: flex;
    flex-direction: column;
}

/* Champs de formulaire */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-size: 16px;
    color: #555;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Style pour le bouton de soumission */
button {
    padding: 10px 15px;
    background-color: #980404;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #980404;
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

        
        <div class="container">
        <h2>Modifier la Commande #{{ $commande->id }}</h2>

        <form action="{{ route('commande.modif', $commande->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom_client">Email du Client :</label>
                <input type="text" id="nom_client" class="form-control" value="{{ $commande->email }}" disabled>
            </div>

            <div class="form-group">
                <label for="email_client">Adresse du Client :</label>
                <input type="email" id="email_client" class="form-control" value="{{ $commande->adresse }}" disabled>
            </div>

            <div class="form-group">
                <label for="statut">Statut de la commande :</label>
                <select name="statut" id="statut" class="form-control" required>
                    <option value="En attente" {{ $commande->statut == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="En préparation" {{ $commande->statut == 'En préparation' ? 'selected' : '' }}>En préparation</option>
                    <option value="Prête" {{ $commande->statut == 'Prête' ? 'selected' : '' }}>Prête</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>

        

    <footer>
        <p>&copy; 2025 ISI BURGER. Tous droits réservés.</p>
    </footer>
</body>
</html>
