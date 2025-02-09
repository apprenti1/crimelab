<!DOCTYPE html>
<html lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link href="<?= $baseurl ?>assets/libs/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script defer src="<?= $baseurl ?>assets/libs/bootstrap/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= $baseurl ?>assets/css/base.css">
    <link rel="stylesheet" href="<?= $baseurl ?>assets/css/master.css">
    <link rel="icon" href="<?= $baseurl ?>assets/img/icon.svg">
    <title><?= $title ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>

<?php require '../template/navbar.php'; ?>
<?php require $template; ?>
    <div id="scrolltoTop" class="disabled position-fixed arrow mb-1 rounded-50px d-flex align-items-center justify-content-center" style="background-color: RebeccaPurple; bottom: 10px; right: 10px; height: 50px; width: 50px; opacity: 0; transition: 0.5s all 0s;">
        <div class="arrow">
            <span></span>
            <span></span>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/lib!s/jquery/3.6.4/jquery.min.js"></script>
    <script src="<?= $baseurl ?>assets/js/main.js"></script>
</body>
</html>