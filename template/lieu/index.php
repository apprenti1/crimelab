


<div class="undernavbar mx-2 mx-md-5">
    <div class="pt-5 mx-5">
        <div class="d-flex flex-column align-items-center justify-content-center">
    <a href="<?=$route?>/new" class="btn btn-primary">+</a>
    </div>
    <table id="datatable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Coordonnées</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lieux as $lieu) { ?>
        <tr>
            <td><?= $lieu->getId(); ?></td>
            <td><?= $lieu->getNom(); ?></td>
            <td><?= $lieu->getAdresse(); ?></td>
            <td><?= $lieu->getCoordonnees(); ?></td>
            <td>
            <a href="<?=$route?>view/<?= $lieu->getId(); ?>" class="btn btn-primary">Editer</a>
            <a href="<?=$route?>edit/<?= $lieu->getId(); ?>" class="btn btn-warning">Editer</a>
            <a href="<?=$route?>delete/<?= $lieu->getId(); ?>" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

</div>