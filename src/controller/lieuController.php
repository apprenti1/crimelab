<?php



require_once Utilities::$basepath.'src/entity/Lieu.php';
require_once Utilities::$basepath.'src/repo/mongo/LieuRepositoryMongo.php';

$lieuRepository = new LieuRepository();


if (strtolower($route) === 'lieu') {
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] === 'new') {
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $coordonnees = $_POST['coordonnees'];
            $lieu = new Lieu(null, $nom, $adresse, $coordonnees, []);
            $lieuRepository->insertLieu($lieu);
        }
        elseif ($_POST['submit'] === 'edit') {
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $coordonnees = $_POST['coordonnees'];
            $lieu = new Lieu($id, $nom, $adresse, $coordonnees, []);
            $lieuRepository->updateLieu($lieu);
        }
        elseif ($_POST['submit'] === 'delete') {
            $id = $_POST['id'];
            $lieuRepository->deleteLieu($id);
        }
    }
    $lieux = $lieuRepository->findAllLieux();
    $title = 'Lieu';
    $template = Utilities::$basepath.'template/lieu/index.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'lieu/new') {
    
    $title = 'Ajouter un lieu';
    $template = Utilities::$basepath.'template/lieu/new.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'lieu/edit') {
    var_dump($_GET);
    $id = $_GET['id'];
    $lieu = $lieuRepository->findLieuById($id);
    $title = 'Modifier un lieu';
    $template = Utilities::$basepath.'template/lieu/new.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'lieu/view') {
    $id = $_GET['id'];
    $lieu = $lieuRepository->findLieuById($id);
    $title = 'Voir un lieu';
    $template = Utilities::$basepath.'template/lieu/view.php';
    require Utilities::$basepath.'template/base.php';
}
?>