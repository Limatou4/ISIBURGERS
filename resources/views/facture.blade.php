<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; }
        h2 { color: #990404; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #990404; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Facture #{{ $commande->id }}</h2>
        <p>Adresse du Client: {{ $commande->adresse }}</p>
        <p>Email: {{ $commande->email }}</p>
        <p>Date: {{ now()->format('d/m/Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Nom du Produit</th>
                    <th>Quantité</th>
                   
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $commande->nomproduit }}</td> 
                    <td>1</td>
                    
                    <td>{{ number_format($commande->total, 2) }} Fcfa</td> 
                </tr>
            </tbody>
        </table>

        <h3>Total : {{ number_format($commande->total, 2) }} Fcfa</h3> 
    </div>
</body>
</html>
