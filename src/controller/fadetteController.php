<?php


require_once Utilities::$basepath.'src/entity/Individu.php';
require_once Utilities::$basepath.'src/repo/neo/IndividuRepositoryNeo.php';
$individuRepository = new IndividuRepository();
require_once Utilities::$basepath.'src/entity/Fadette.php';
require_once Utilities::$basepath.'src/repo/neo/FadetteRepositoryNeo.php';
$fadetteRepository = new FadetteRepository();


if (strtolower($route) === 'fadette') {
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] === 'new') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $adresse = $_POST['adresse'];
            $telephone = $_POST['telephone'];
            $appelants = $_POST['appelants'];
            $date = $_POST['date'];
            $individu = new Individu(null, $nom, $prenom, "", $telephone, $adresse);
            $individuRepository->insertIndividu($individu);
            $fadette = new Fadette(null, $individu, $appelants, $date);
            $fadetteRepository->insertFadette($fadette);
        }
        elseif ($_POST['submit'] === 'edit') {
            $id = $_POST['id'];
            $date = $_POST['date'];
            $appelants = $_POST['appelants'];
            $oldFadette = $fadetteRepository->findFadetteById($id);
            $oldFadette->setAppelants($appelants);
            $oldFadette->setDate($date);
            $fadetteRepository->updateFadette($oldFadette);
        }
        elseif ($_POST['submit'] === 'delete') {
            $id = $_POST['id'];
            $fadetteRepository->deleteFadette($id);
        }
    }
    $fadettes = $fadetteRepository->findAllFadettes();
    $title = 'Voir une fadette';
    $template = Utilities::$basepath.'template/fadette/index.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'fadette/new') {
    
    $title = 'Ajouter une fadette';
    $template = Utilities::$basepath.'template/fadette/new.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'fadette/edit') {
    var_dump($_GET);
    $id = $_GET['id'];
    $fadette = $fadetteRepository->findFadetteById($id);
    $title = 'Modifier une fadette';
    $template = Utilities::$basepath.'template/fadette/new.php';
    require Utilities::$basepath.'template/base.php';
}
elseif (strtolower($route) === 'fadette/view') {
    $id = $_GET['id'];
    $fadette = $fadetteRepository->findFadetteById($id);
    $title = 'Voir une fadette';
    $template = Utilities::$basepath.'template/fadette/view.php';
    require Utilities::$basepath.'template/base.php';
}
?>