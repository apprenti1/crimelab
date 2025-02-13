<div class="undernavbar mx-2 mx-md-5">
    <div class="pt-5 mx-5 d-flex flex-column align-items-center justify-content-center">
        <h3>Nouveau Lieu</h3>
        <form action="<?= $route ?>/create" method="post">
            <div class="form-group mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
            <div class="form-group mb-3">
                <label for="coordonnees" class="form-label">Coordonnées</label>
                <input type="text" class="form-control" id="coordonnees" name="coordonnees" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</div>
