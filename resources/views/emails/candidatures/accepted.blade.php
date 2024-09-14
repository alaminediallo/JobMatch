<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap" rel="stylesheet">
    <title>Candidature acceptée</title>
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
<div class="email-container"><!-- Header -->
    <div class="email-header">
        Votre candidature a été acceptée
    </div>

    <!-- Body -->
    <div class="email-content">
        <p>Bonjour <span>{{ $nomCandidat }}</span>,</p>

        <p>
            Nous sommes ravis de vous informer que votre candidature pour le poste de <span>{{ $titreOffre }}</span>
            chez <span>{{ $nomEntreprise }}</span> a été retenue.
        </p>

        <p>
            Votre profil a particulièrement attiré notre attention, et nous aimerions vous rencontrer lors d'un
            entretien afin de discuter plus en détail de votre parcours et des opportunités que nous pourrions vous
            offrir chez <span>{{ $nomEntreprise }}</span>.
        </p>

        <p>
            Nous vous communiquerons prochainement la date et l'heure de l'entretien. En attendant, n'hésitez pas à nous
            contacter si vous avez des questions ou des informations supplémentaires à nous fournir.
        </p>

        <p>
            Nous vous remercions de l'intérêt que vous portez à <span>{{ $nomEntreprise }}</span> et nous nous
            réjouissons de vous rencontrer.
        </p>

        <p>Cordialement,</p>
        <p><span>{{ $nomEntreprise }}</span></p>
    </div>

    <!-- Footer -->
    <div class="email-footer">
        Merci, {{ config('app.name') }}
    </div>
</div>
</body>
</html>
