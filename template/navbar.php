<div class="navbar">
<link rel="stylesheet" href="<?= Utilities::$baseurl ?>assets/css/navbar.css">

    <div class="content w-100 h-100 d-flex flex-wrap text-white">
        <div class="col-12 col-sm-8 col-md-5 h-100 d-flex align-items-center p-3 flex-wrap justify-content-center">
            <a href="<?=Utilities::$baseurl.((str_starts_with($route, 'home'))?'#accueil':'')?>" class="p-2 text-decoration-none d-flex align-items-center justify-content-center containerUnderlined animpadding" style="border-radius: 100px; height: 60px; color: #fff;">
                <p class="m-0 p-2 text-center underlined<?=str_starts_with($route, 'home')? " everunderlined" : ""?>">Acueil</p>
            </a>
            <a href="<?=Utilities::$baseurl.''?>" class="p-2 text-decoration-none d-flex align-items-center justify-content-center containerUnderlined animpadding" style="border-radius: 100px; height: 60px; color: #fff;">
                <p class="m-0 p-2 text-center underlined<?=str_starts_with($route, 'affaire')? " everunderlined" : ""?>">Dossiers</p>
            </a>
            <a href="<?=Utilities::$baseurl.'fadette'?>" class="p-2 text-decoration-none d-flex align-items-center justify-content-center containerUnderlined animpadding" style="border-radius: 100px; height: 60px; color: #fff;">
                <p class="m-0 p-2 text-center underlined<?=str_starts_with($route, 'fadette')? " everunderlined" : ""?>">Fadettes</p>
            </a>
            <a href="<?=Utilities::$baseurl.'individu'?>" class="p-2 text-decoration-none d-flex align-items-center justify-content-center containerUnderlined animpadding" style="border-radius: 100px; height: 60px; color: #fff;">
                <p class="m-0 p-2 text-center underlined<?=str_starts_with($route, 'individu')? " everunderlined" : ""?>">Individus</p>
            </a>
            <a href="<?=Utilities::$baseurl.'lieu'?>" class="p-2 text-decoration-none d-flex align-items-center justify-content-center containerUnderlined animpadding" style="border-radius: 100px; height: 60px; color: #fff;">
                <p class="m-0 p-2 text-center underlined<?=str_starts_with($route, 'lieu')? " everunderlined" : ""?>">Lieux</p>
            </a>
            <a href="<?=Utilities::$baseurl.''?>" class="p-2 text-decoration-none d-flex align-items-center justify-content-center containerUnderlined animpadding" style="border-radius: 100px; height: 60px; color: #fff;">
                <p class="m-0 p-2 text-center underlined<?=str_starts_with($route, 'info')? " everunderlined" : ""?>">A propos</p>
            </a>
            <?php if (str_starts_with($route, 'admin')) { ?>
            <a href="<?= Utilities::$baseurl ?>admin<?= (str_starts_with($route, 'admin'))?'#admin':'' ?>" class="<?= (str_starts_with($route, 'admin'))? "everunderlined " : "" ?>p-2 text-decoration-none d-flex align-items-center justify-content-center containerUnderlined animpadding" style="border-radius: 100px; height: 60px; color: #fff;">
                <p class="m-0 p-2 text-center underlined"> <img class="icon inverted" style="height: 30px;" src="<?= Utilities::$baseurl ?>assets/img/admin.png" alt=""> Admin</p>
            </a>
            <?php } ?>
        </div>
        <div class="col-12 col-sm-4 col-md-2 h-100 d-flex justify-content-center align-items-center">
            <a class="h-100" href="<?= Utilities::$baseurl ?>">
                <img src="<?= Utilities::$baseurl ?>assets/img/brand.svg" alt="Icon crimelab" class="py-md-3 py-sm-3 py-3 inverted" style="height: 90px;">
            </a>
        </div>
        <div class="col-12 col-sm-12 col-md-5 h-100 d-flex align-items-center justify-content-center">
            <div class="border-2 border-white border mt-3 mb-3 ms-3 d-flex align-items-center px-2 py-1" style="flex: 0.8; height: 40px !important; border-radius:20px;">
                <img src="assets/img/glass.png" alt="" class="h-75 inverted">
                <input type="text" class="bg-transparent flex-fill border-0 text-center">
            </div>

        </div>
    </div>
</div>