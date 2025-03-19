<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Burgers</title>
    <style>
        /* Styles globaux */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            background: url('{{ asset("images/background.png") }}') no-repeat center center;
            background-size: cover;
            position: relative;
        }

        /* Overlay pour assombrir légèrement le fond */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Opacité pour un bel effet */
        }

        /* Conteneur du formulaire */
        .form-container {
            position: absolute;
            top: 50%;
            left: 10%; /* Positionné à gauche */
            transform: translateY(-50%);
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 350px;
            opacity: 0.95; /* Légère transparence */
            border-left: 8px solid #990404; /* Bordure gauche pour un effet stylé */
        }

        h2 {
            text-align: center;
            color: #990404;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #FFC5A4;
            border-radius: 5px;
            background: #FFF5EE;
            font-size: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #990404;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #700303;
        }

        .form-footer {
            text-align: center;
            margin-top: 15px;
        }

        .form-footer a {
            color: #990404;
            font-weight: bold;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="form-container">
        <h2>Connexion</h2>

        <!-- Formulaire de connexion -->
        <form method="POST" action="{{ route('login.store') }}">
    @csrf

    <!-- Email -->
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required>

    <!-- Mot de passe -->
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>

    <!-- Bouton de connexion -->
    <button type="submit" class="btn-submit">Se connecter</button>
</form>



        <!-- Lien d'inscription -->
        <div class="form-footer">
            <p>Pas encore de compte? <a href="{{ url('/inscription') }}">S'inscrire</a></p>
        </div>
    </div>

</body>
</html>
