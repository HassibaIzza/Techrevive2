<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fiche de Réparation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f9;
            border: 1px solid #ccc;
            border-radius: 10px;
            max-width: 600px;
            max-height: 60px;
             
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .subtitle {
            text-align: center;
            color: #555;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1em;
            line-height: 1.5;
            margin: 10px 0;
            color: #555;
        }

        .repair-details {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
        }

        .repair-details p {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .repair-details p:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .label {
            font-weight: bold;
            color: #000;
        }

        .value {
            color: #007bff;
        }

        .footer {
            text-align: center;
            margin-top: 400px;
            color: #aaa;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h1>Fiche de Réparation</h1>
    <div class="subtitle">Entreprise : {{ $panne->nom_marque }}</div>
    <div class="repair-details">
        <p><span class="label">Nom du client:</span> <span class="value">{{ $panne->nom }}</span></p>
        <!--<p><span class="label">Nom de la panne:</span> <span class="value">{{ $panne->nom_panne }}</span></p>-->
        <p><span class="label">Adresse:</span> <span class="value">{{ $panne->sujet }}</span></p>
        <p><span class="label">Catégorie:</span> <span class="value">{{ $panne->nom_catégorie }}</span></p>
         <p><span class="label">Modèle de l'appareil:</span> <span class="value">{{ $panne->modele }}</span></p>
        <p><span class="label">Prix de réparation:</span> <span class="value">{{ $panne->prix }}</span></p>
       
        <!--<p><span class="label">Status:</span> <span class="value">{{ $panne->status }}</span></p>
        <p><span class="label">Détails:</span> <span class="value">{{ $panne->problème }}</span></p>-->
    </div>
    <div class="footer">
    <br><br> 
    Date de génération: {{ $date_generation }} <br>
        Fiche de réparation générée par TechRevive
    </div>
</body>
</html>
