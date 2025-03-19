<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Burger Gourmet</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F6C7B4;
            padding-top: 80px; /* To make space for the fixed navbar */
        }

        /* Navbar */
        .navbar {
            background-color: #980404;
            padding: 30px 0;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            margin: 0 15px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #ff5722;
            border-radius: 5px;
        }

        .navbar .logo {
            font-size: 30px;
            font-weight: bold;
            color: white;
            margin-left: 200px;
        }

        /* Profile Section */
        .profile-section {
            position: fixed;
            top: 80px; /* To leave space for the navbar */
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #F6C7B4;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            z-index: 500;
            box-shadow: 0 4px 12px #980404;
        }

        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px #980404;
            width: 100%;
            margin-bottom: 40px;
        }

        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #980404;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-name {
            font-size: 18px;
            font-weight: bold;
            color: white;
            text-align: center;
        }

        /* Menu */
        .menu {
            width: 100%;
            text-align: left;
            padding: 20px;
            margin-top: 20px;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 18px;
            transition: background-color 0.3s;
            background-color: rgb(152, 4, 4);
        }

        .menu a:hover {
            background-color: #ff5722;
            border-radius: 5px;
        }

        /* Section Menu */
        .menu-section {
            text-align: center;
            padding: 40px 15px;
            background-color: #F6C7B4;
            margin-left: 270px;
        }

        .menu-section h2 {
            font-size: 28px;
            color: #980404;
            margin-bottom: 25px;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Grille des Burgers */
        .menu-section .row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Carte Burger */
        .burger-card {
            background-color: #fff;
            width: 200px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            overflow: hidden;
        }

        .burger-card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        /* Image Burger */
        .burger-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Titre et description */
        .burger-card h3 {
            font-size: 18px;
            color: #980404;
            margin: 10px 0;
        }

        .burger-card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        /* Prix */
        .burger-card .price {
            font-size: 16px;
            font-weight: bold;
            color: #980404;
            margin-bottom: 10px;
        }

        /* Bouton */
        .burger-card .btn {
            display: inline-block;
            background-color: #980404;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.2s ease-in-out;
        }

        .burger-card .btn:hover {
            background-color: #e64a19;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        footer p {
            font-size: 16px;
        }

        /* Style de base, tu peux garder ce que tu as déjà fait */
        .panier-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .panier-table th, .panier-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            color: #333;
        }

        .panier-table th {
            background-color: #980404;
            color: white;
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #980404;
            text-align: right;
            padding: 10px 20px;
        }

        .btn-validation {
            background-color: #980404;
            color: white;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-validation:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>

    <!-- Left Profile Section -->
    <div class="profile-section">
        <div class="profile">
            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profil">
            <p class="profile-name">{{ Auth::user()->name }}</p>
        </div>

        <!-- Menu in Profile Section -->
        <div class="menu">
            <a href="{{ route('client.home') }}">🏠 Accueil</a>
            <a href="{{ route('panier') }}">🛒 Mon Panier<i class="fas fa-shopping-cart"></i></a>
            <a href="#">🍔 Restaurants</a>
            <a href="{{ route('Listecommande') }}">📦 Commandes</a>
            <a href="{{ route('login.store') }}">⬅️ Déconnexion</a>
        </div>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <span class="logo">Bonjour, {{ Auth::user()->name }} ❤️- Bienvenue chez ISI Burgers ! 🍔🍟🥤 </span>
    </div>

    
        
      
    <div class="menu-section">
        <h2>Mes Commandes</h2>

        <!-- Vérifier s'il y a des commandes -->
        @if($commandes->isEmpty())
            <p>Vous n'avez pas encore passé de commandes.</p>
        @else
            <table class="panier-table">
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ $commande->created_at->format('d-m-Y') }}</td>
                            <td>{{ $commande->statut }}</td>
                            <td>{{ $commande->total }} Fcfa</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    

        

    

</body>

</html>
