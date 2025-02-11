<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= Utilities::$baseurl ?>assets/libs/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script defer src="<?= Utilities::$baseurl ?>assets/libs/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= Utilities::$baseurl ?>assets/css/base.css">
    <link rel="icon" href="<?= Utilities::$baseurl ?>assets/img/icon.svg">
    <title><?= $title ?></title>
    <style>
        body {
            background: linear-gradient(#ddd9, #dddd), url(<?= Utilities::$baseurl ?>assets/img/icon.svg) no-repeat;
            height: 100vh;
            width: 100vw;
            background-position: center;
            background-size: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <div class="d-flex flex-column justify-content-center align-items-center p-3 rounded-4" style="background-color: #000a;">
        <h2>Error: 404</h2>
        <h3>Page not found</h3>
        <p class="mb-2">Oups, on dirait que cette page n'existe pas...</p>
        <div style="padding: 20px; width:fit-content; border-radius: 20px; background-color: #000;">
            <a href="<?= Utilities::$baseurl ?>" class="text-decoration-none containerUnderlined" style="border-radius: 100px; color: #fff;">
                <p class="m-0 p-0 underlined">retour à</p>
                <br>
                <p class="m-0 p-0 underlined">l'accueil</p>
            </a>
        </div>
    </div>
</body>
</html>