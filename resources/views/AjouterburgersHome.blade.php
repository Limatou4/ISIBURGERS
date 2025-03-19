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
        margin-bottom: 10px; /* Réduit la marge sous la section de profil */
    }

    .profile-img {
        border-radius: 50%;
        width: 80px; /* Réduction de la taille de l'image */
        height: 80px; /* Réduction de la taille de l'image */
        object-fit: cover;
        border: 4px solid #990404;
    }

    .welcome-message {
        font-size: 16px;
        font-weight: bold;
        margin-top: 5px; /* Réduction de l'espacement */
    }

    .form-group {
        margin-bottom: 8px; /* Réduit l'espace entre les groupes de champs */
        width: 100%;
    }

    label {
        font-size: 14px;
        margin-bottom: 3px; /* Réduction de l'espace sous les labels */
        color: #990404;
        font-weight: bold;
    }

    input[type="text"], input[type="number"], input[type="file"], input[type="text"], textarea {
        width: 100%;
        padding: 3px; /* Réduction du padding */
        margin-top: 3px; /* Réduction de l'espace entre le champ et le label */
        border: 2px solid #990404;
        border-radius: 5px;
        font-size: 14px;
        background-color: #fff;
    }

    input[type="text"]:focus, input[type="number"]:focus, input[type="file"]:focus, textarea:focus {
        outline: none;
        border-color: #d13b3b;
    }

    .btn-submit {
        background-color: #990404;
        color: white;
        padding: 7px 12px; /* Réduction du padding */
        font-size: 14px;
        border-radius: 5px;
        border: none;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #d13b3b;
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
</style>


</head>
<body>
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

        <form method="POST" action="{{ route('burgers.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Champs de formulaire -->
    <div class="form-group">
        <label for="nom">Nom du Burger</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
    </div>
    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="number" id="prix" name="prix" step="0.01" value="{{ old('prix') }}" required>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required>
    </div>
    <div class="form-group">
        <label for="archived">Archivé</label>
        <input type="checkbox" id="archived" name="archived" value="1" {{ old('archived') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn-submit">Ajouter le Burger</button>
</form>

    </div>

    <footer>
        <p>&copy; 2025 ISI BURGER. Tous droits réservés.</p>
    </footer>
</body>
</html>
