<div class="container my-4">
    <a href="<?= $router->generate('students_add') ?>" class="btn btn-success float-end">Ajouter</a>
    <h2>Liste des Etudiants</h2>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($viewData["students"] as $student): ?>
            <tr>
                <th scope="row"><?= $student->getId(); ?></th>
                <td><?= $student->getFirstname(); ?></td>
                <td><?= $student->getLastname(); ?></td>
                <td><?= $student->getStatus(); ?></td>
                <td class="text-end">
                    <a href="<?= $router->generate('students_update', [ "studentid" => $student->getId() ]) ?>" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                 
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>