<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap" rel="stylesheet">
    <title>Nouvelle Offre Créée</title>
    <style>
        body {
            font-family: inter, system-ui, sans-serif;
            font-size: 16px;
            font-weight: 400;
            background-color: #f8f9fc;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 50px auto;
            border-radius: 6px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 0 3px rgba(60, 72, 88, 0.15);
            border: none;
        }

        .email-header {
            background-color: #2f55d4;
            color: #ffffff;
            text-align: center;
            font-size: 24px;
            letter-spacing: 1px;
            padding: 20px 0;
        }

        .email-content {
            padding: 20px 24px 0;
            color: #161c2d;
            font-size: 1rem !important;
        }

        .email-button {
            padding: 15px 24px;
            text-align: center;
        }

        .email-button a {
            padding: 8px 25px;
            text-decoration: none;
            font-size: 16px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            font-weight: 600;
            border-radius: 6px;
            background-color: #2f55d4;
            border: 1px solid #2f55d4;
            color: #ffffff;
            display: inline-block;
        }

        .email-footer {
            padding: 16px 8px;
            text-align: center;
            color: #8492a6;
            background-color: #f8f9fc;
        }

        ul {
            padding-left: 0px;
            list-style: none;
        }

        ul li {
            margin-bottom: 7px;
        }

        ul li span {
            display: inline-block;
            min-width: 215px;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Header -->
    <div class="email-header">
        Nouvelle Offre d'Emploi Créée
    </div>

    <!-- Body -->
    <div class="email-content">
        Une nouvelle offre d'emploi a été créée et en attente de validation avec les détails suivants :
    </div>

    <!-- Offer Details -->
    <div class="email-content" style="padding-top: 0;">
        <ul>
            <li><span>Titre :</span> {{ $offre->title }}</li>
            <li><span>Salaire :</span> {{ $offre->salaire_proposer .  ' FCFA' }}</li>
            <li><span>Date de début :</span> {{ $offre->date_debut->format('D d, M Y') }}</li>
            <li><span>Date de fin :</span> {{ $offre->date_fin->format('D d, M Y') }}</li>
            <li><span>Nom de l'entreprise :</span> {{ $offre->user->nom_entreprise }}</li>
            <li><span>Type d'entreprise :</span> {{ $offre->user->typeEntreprise->name }}</li>
            <li><span>Nom complet du recruteur :</span> {{ $offre->user->name . ' ' . $offre->user->prenom }}</li>
            <li><span>Email du recruteur :</span> {{ $offre->user->email }}</li>
        </ul>
    </div>

    <!-- Button -->
    <div class="email-button">
        <a href="{{ route('offre.show', $offre) }}">Voir l'offre</a>
    </div>

    <!-- Footer -->
    <div class="email-footer">
        Merci, {{ config('app.name') }}
    </div>
</div>
</body>
</html>
