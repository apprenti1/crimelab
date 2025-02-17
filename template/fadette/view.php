
<div class="container undernavbar justify-content-center align-items-center d-flex">
    <div class="col-6 col-md-3">
        <h2>Détails du Individu</h2>
            <div class="form-group mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= isset($individu)?$individu->getNom():'' ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= isset($individu)?$individu->getPrenom():'' ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?= isset($individu)?$individu->getAdresse():'' ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="telephone" class="form-label">Numéro de téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" value="<?= isset($individu)?$individu->getTelephone():'' ?>" required>
            </div>
        <div class="d-flex justify-content-center">
            <a href="<?=(Utilities::$baseurl)?>fadette/edit/?id=<?= $individu->getId() ?>" class="btn btn-warning m-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
            </a>
            <?php include 'delete.php'; ?>
            <a href="<?=(Utilities::$baseurl)?>fadette" class="btn btn-secondary m-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
            </svg>
            </a>
        </div>
    </div>
</div>

