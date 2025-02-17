<div class="undernavbar mx-2 mx-md-5">
    <div class="pt-5 mx-5 d-flex flex-column align-items-center justify-content-center">
        <h3>Création d'une fadette</h3>
        <form action="<?= Utilities::$baseurl.'fadette' ?>" method="post">
            <div class="form-group mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group mb-3">
                <label for="lieu" class="form-label">Lieu</label>
                <select class="form-control" id="lieu" name="lieu" required>
                    <?php
                    foreach ($lieux as $lieu) {
                        ?>
                        <option value="<?= $lieu->getId() ?>"><?= $lieu->getNom() ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" value="new" class="btn btn-primary m-2 p-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
            </svg>
            </button>
            <a href="<?=(Utilities::$baseurl)?>fadette" class="btn btn-secondary m-2 p-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
            </svg>
            </a>
        </form>
    </div>
</div>

