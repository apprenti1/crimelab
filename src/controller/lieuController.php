<?php



require_once Utilities::$basepath.'src/repo/mongo/LieuRipositoryMongo.php';

$lieuRepository = new LieuRepository();


if (strtolower($route) === 'lieu') {
    # code...
    $lieux = $lieuRepository->findAllLieux();
    $title = 'Lieu';
    $template = Utilities::$basepath.'template/lieu/index.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'lieu/new') {
    # code...
    $title = 'Ajouter un lieu';
    $template = Utilities::$basepath.'template/lieu/new.php';
    require Utilities::$basepath.'template/base.php';
}
?>