<?php

require_once Utilities::$basepath.'src/entity/Individu.php';
require_once Utilities::$basepath.'src/repo/neo/IndividuRepositoryNeo.php';
$individuRepository = new IndividuRepository();

try {
    
    
    if (strtolower($route) === 'individu') {
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] === 'new') {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $adresse = $_POST['adresse'];
                $telephone = $_POST['telephone'];
                $individu = new Individu(null, $nom, $prenom, "", $telephone, $adresse);
                $individuRepository->insertIndividu($individu);
            }
            elseif ($_POST['submit'] === 'edit') {
                $id = $_POST['id'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $adresse = $_POST['adresse'];
                $telephone = $_POST['telephone'];
                $individu = new Individu($id, $nom, $prenom, "", $telephone, $adresse);
                $individuRepository->updateIndividu($individu);
            }
            elseif ($_POST['submit'] === 'delete') {
                $id = $_POST['id'];
                $individuRepository->deleteIndividu($id);
            }
        }
        $individus = $individuRepository->findAllIndividus();
        $title = 'Voir un individu';
        $template = Utilities::$basepath.'template/individu/index.php';
        require Utilities::$basepath.'template/base.php';
    }
    elseif (strtolower($route) === 'individu/new') {
        
        $title = 'Ajouter un individu';
        $template = Utilities::$basepath.'template/individu/new.php';
        require Utilities::$basepath.'template/base.php';
    }
    elseif (strtolower($route) === 'individu/edit') {
        $id = $_GET['id'];
        $individu = $individuRepository->findIndividuById($id);
        $title = 'Modifier un individu';
        $template = Utilities::$basepath.'template/individu/new.php';
        require Utilities::$basepath.'template/base.php';
    }
    elseif (strtolower($route) === 'individu/view') {
        $id = $_GET['id'];
        $individu = $individuRepository->findIndividuById($id);
        $title = 'Voir un individu';
        $template = Utilities::$basepath.'template/individu/view.php';
        require Utilities::$basepath.'template/base.php';
    }
} catch (\Throwable $th) {
    echo "<pre>";
    var_dump($th->getMessage());
    echo "</pre>";
}
?>