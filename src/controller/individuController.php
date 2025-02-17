<?php

require_once Utilities::$basepath.'src/entity/Individu.php';
require_once Utilities::$basepath.'src/repo/neo/IndividuRepositoryNeo.php';
$individuRepository = new IndividuRepository();


if (strtolower($route) === 'individu') {
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] === 'new') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateDeNaissance = $_POST['dateDeNaissance'];
            $adresse = $_POST['adresse'];
            $telephone = $_POST['telephone'];
            $individu = new Individu(null, $nom, $prenom, "", $dateDeNaissance, $adresse, $telephone);
            $individuRepository->insertIndividu($individu);
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
    $individus = $individuRepository->findAllIndividus();
    $title = 'Voir un individu';
    $template = Utilities::$basepath.'template/individu/index.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'individu/new') {
    
    $title = 'Ajouter un lieu';
    $template = Utilities::$basepath.'template/individu/new.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'lieu/edit') {
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