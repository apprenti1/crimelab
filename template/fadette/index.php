<div class="undernavbar mx-2 mx-md-5">
    <div class="pt-5 mx-5">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <a href="<?=(Utilities::$baseurl.$route)?>/new" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
            </a>
        </div>
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Individu</th>
                    <th>Appelant</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fadettes as $fadette) { ?>
                <tr>
                    <td><?= $fadette->getId(); ?></td>
                    <td><?= $fadette->getIndividu()->getPrenom()." ".$fadette->getIndividu()->getPrenom() ?></td>
                    <!-- Todo : Revoir la gestion des types de appelants et de date -->
                    <!-- <td><?php //echo $fadette->getAppelants()['tel']; ?></td> -->
                    <td><?= $fadette->getAppelants(); ?></td>
                    <!-- <td><? //echo $fadette->getDate()->format('d/m/Y'); ?></td> -->
                    <td><?= $fadette->getDate(); ?></td>
                    <td class="d-flex justify-content-center">
                        <a href="<?=(Utilities::$baseurl.$route)?>/view/?id=<?= $fadette->getId() ?>" class="btn btn-primary m-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                        </a>
                        <a href="<?=(Utilities::$baseurl.$route)?>/edit/?id=<?= $fadette->getId() ?>" class="btn btn-warning m-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                        <?php include 'delete.php'; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
