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
                $individu = new Individu(null, $nom, $prenom, "", $telephone, $adresse, null);
                $individuRepository->insertIndividu($individu);
            }
            elseif ($_POST['submit'] === 'edit') {
                $id = $_POST['id'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $adresse = $_POST['adresse'];
                $telephone = $_POST['telephone'];
                $individu = new Individu($id, $nom, $prenom, "", $telephone, $adresse, null);
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
    elseif (strtolower($route) === 'individu/ajax') {
        header('Content-Type: application/json');

        $limit = $_GET['limit'] ?? '10';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;
        $nom = $_GET['nom'] ?? 'z';
        $prenom = $_GET['prenom'] ?? 'z';

        $result = Utilities::connectNeo4j()->createSession()->run(
            'MATCH (i:Individu) WHERE 
             '.(isset($id) ? ('id(i) = '.$id.' OR'):'').'
             i.nom =~ "(?i).*'.$nom.'.*" 
             OR i.prenom =~ "(?i).*'.$prenom.'.*" 
             RETURN i'
        );
        
        echo json_encode($result);
    }
} catch (\Throwable $th) {
    echo "<pre>";
    var_dump($th->getMessage());
    echo "</pre>";
}
?>