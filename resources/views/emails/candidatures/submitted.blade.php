<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap" rel="stylesheet">
    <title>Nouvelle candidature soumise</title>
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
            padding-bottom: 10px;
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

        span {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Header -->
    <div class="email-header">
        Nouvelle candidature reçue
    </div>

    <!-- Body -->
    <div class="email-content">
        <p> Bonjour <span>{{ $nomRecruteur }}</span>,</p>

        <p>
            Nous vous informons qu'une nouvelle candidature a été soumise pour le poste de
            <span>{{ $titreOffre }}</span> chez <span>{{ $nomEntreprise }}</span>.
        </p>

        <p>
            Le candidat, <span>{{ $nomCandidat }}</span>, a soumis sa candidature pour cette offre. Nous vous
            invitons à consulter les détails de la candidature via votre espace recruteur pour en examiner les
            informations et planifier les prochaines étapes, si nécessaire.
        </p>

        <!-- Button -->
        <div class="email-button">
            <a href="{{ route('candidature.show', [$offreId, $candidatureId]) }}">Consulter la candidature</a>
        </div>

        <p>
            Nous vous remercions de la confiance que vous accordez à <span>{{ config('app.name') }}</span> pour vos
            recrutement.
        </p>

    </div>
    <!-- Footer -->
    <div class="email-footer">
        Merci, {{ config('app.name') }}
    </div>
</div>
</body>
</html>
