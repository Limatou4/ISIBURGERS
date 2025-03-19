<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Burgers</title>
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
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Conteneur du formulaire */
        .form-container {
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translateY(-50%);
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 350px;
            opacity: 0.95;
            border-left: 8px solid #990404;
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

        input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #FFC5A4;
            border-radius: 5px;
            background: #FFF5EE;
            font-size: 14px;
        }

        input[type="file"] {
            background: white;
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
        <h2>Inscription</h2>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">

            @csrf

            <!-- Nom -->
            <label for="name">Nom complet</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>

            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <!-- Mot de passe -->
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <!-- Confirmation du mot de passe -->
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <!-- Image de profil -->
            <label for="image">Image de profil</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn-submit">S'inscrire</button>
        </form>

        <div class="form-footer">
            <p>Déjà un compte? <a href="{{ url('/connexion') }}">Se connecter</a></p>
        </div>
    </div>

</body>
</html>
