<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= $baseurl ?>assets/libs/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script defer src="<?= $baseurl ?>assets/libs/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= $baseurl ?>assets/css/base.css">
    <link rel="icon" href="<?= $baseurl ?>assets/img/icon.svg">
    <title><?= $title ?></title>
    <style>
        body {
            background: linear-gradient(#ddd9, #dddd), url(<?= $baseurl ?>assets/img/icon.svg) no-repeat;
            height: 100vh;
            width: 100vw;
            background-position: center;
            background-size: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        strong {
            color: var(--bs-danger-text-emphasis);
        }
        .alert-danger {
            background-color: #f8d7da88;
        }
        
    </style>
</head>
<body>
    <div class="d-flex flex-column justify-content-center align-items-center p-3 rounded-4" style="background-color: #000a;max-width: 50%;">
        <h2>Error: 503</h2>
        <h3>Server error</h3>
        <p class="mb-2">Oups, on dirait que cette page crée une erreur de traitement...</p>
        <?php
        if (isset($e)) {
        ?>
        <p class="mb-2 col-12 text-start alert alert-danger">
            <strong>Message d'erreur: </strong><?=$e->getMessage()?><br>
            <strong>Fichier: </strong><?=$e->getFile()?><br>
            <strong>Ligne: </strong><?=$e->getLine()?><br>
            <strong>Stack Trace: </strong><br>
            <?=$e->getTraceAsString()?>
        </p>
        <?php
        }
        ?>
        <div style="padding: 20px; width:fit-content; border-radius: 20px; background-color: #000;">
            <a href="<?= $baseurl ?>" class="text-decoration-none containerUnderlined" style="border-radius: 100px; color: #fff;">
                <p class="m-0 p-0 underlined">retour à</p>
                <br>
                <p class="m-0 p-0 underlined">l'accueil</p>
            </a>
        </div>
    </div>
</body>
</html>