<?php

require_once Utilities::$basepath.'src/entity/Fadette.php';
require_once Utilities::$basepath.'src/repo/neo/FadetteRepositoryNeo.php';
$fadetteRepository = new FadetteRepository();


if (strtolower($route) === 'fadette') {
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
    $fadettes = $fadetteRepository->findAllFadettes();
    $title = 'Voir un lieu';
    $template = Utilities::$basepath.'template/fadette/index.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'fadette/new') {
    
    $title = 'Ajouter un lieu';
    $template = Utilities::$basepath.'template/fadette/new.php';
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