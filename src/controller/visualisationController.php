<?php

require_once Utilities::$basepath.'src/repo/neo/VisualisationRepositoryNeo.php';
$visualisationRepository = new VisualisationRepository();


if (strtolower($route) === 'visualisation') {
    $visualisation = $visualisationRepository->findAllFadettes();
    $title = 'Visualiser une fadette';
    $template = Utilities::$basepath.'template/visualisation/index.php';
    require Utilities::$basepath.'template/base.php';
}
?>