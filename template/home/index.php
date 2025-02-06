
<link rel="stylesheet" href="<?= $baseurl ?>assets/css/home.css">
<div id="background" class="background">
        <img class="svg-icon" alt="" src="assets/img/icon.svg"></img>
    </div>
    <div id="accueil" class="accueil-md d-flex flex-wrap justify-content-start align-items-center mx-2 mx-md-5">
        <div class="ps-0 pe-0 ps-md-5 pe-md-1 col-12 col-md-7 justify-content-md-center align-items-md-center cu-text-md-center">
            <h2 class="orbitron">
                WELCOME
            </h2>
            <p class="">
            <strong>CrimeLab - L'Analyse Criminelle Réinventée 🔍🚔</strong><br>
            <p class="ms-3">
                CrimeLab est un outil innovant conçu pour aider les enquêteurs à relier efficacement les éléments d’une affaire criminelle. Grâce à une interface intuitive, il permet de centraliser toutes les informations essentielles : suspects, témoins, lieux, témoignages et communications téléphoniques.<br>
                <br>
                Avec CrimeLab, il devient possible de :<br>
                <p class="ms-5">
                    ✔️ Visualiser les connexions entre individus et événements 📌<br>
                    ✔️ Analyser les appels téléphoniques pour identifier des réseaux criminels 📞<br>
                    ✔️ Localiser les déplacements des suspects en fonction des antennes relais 📍<br>
                    ✔️ Explorer rapidement un dossier et retrouver les liens cachés entre les éléments 🔎<br>
                    <?php
                    var_dump($result);
                    ?>
                </p>
                <br>
                Cet outil donne aux forces de l’ordre une vision claire et détaillée des affaires, facilitant ainsi la prise de décision et l’avancement des enquêtes. CrimeLab, parce que chaque détail compte. 🕵️‍♂️<br>
            </p>
            </p>
        </div>
        <div class="col-12 pt-5 pb-3 col-md-5 min-vh-0 min-vh-md-100 pe-1 d-flex flex-column align-items-center justify-content-center">
            <img src="assets/img/home/1.jpg" alt="" class="w-100 p-3 cp-md-5">
            <a href="" class="border-white text-white rounded-4 fw-bolder border border-2 px-5 py-3 text-decoration-none">CONSULTER</a>
        </div>

    </div>
<div id="boutique" class="d-flex flex-wrap justify-content-center">

<?php
for ($i=0; $i < 1; $i++) { 
?>

<a href="#test" class="text-decoration-none product-thunmbail overflow-hidden d-flex align-items-center flex-column">
    <img src="assets/img/articles/Collier universel X series C0-U41X-S/photo_2024-09-08_23-41-45.jpg" alt="" class="p-3">
    <h3 class="mx-1 mt-2" style="font-size: 1.2rem; color: #fff;">
        Collier en latex
        <p class="mx-1 mt-2" style="font-size: 1rem;">personalisé</p>
        <p class="orbitron mx-1 mt-2" style="font-size: 1.2rem;">150€</p>
    </h3>
</a>


        <?php
}
?>

<script src="assets/js/home/backmove.js"></script>
