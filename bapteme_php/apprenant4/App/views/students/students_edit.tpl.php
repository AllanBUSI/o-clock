<?php $student = $viewData["student"] ?>

<div class="container my-4">
    <a href="<?= $router->generate('students') ?>" class="btn btn-success float-end">Retour</a>
    <h2>Modification d'un etudiant</h2>

    <?php
        // On inclut des sous-vues => "partials"
        include __DIR__ . '/../partials/errors.tpl.php';
    ?>

    <form action="<?= $router->generate('students_update', [ "studentid" => $student->getId() ]) ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Firstname</label>
            <input name="Firstname" value="<?= $student->getFirstname() ?>" type="text" class="form-control" id="firstname" placeholder="Prenom de l'etudiant'">
        </div>
        <div class="form-group">
            <label for="name">Lastname</label>
            <input name="Lastname" value="<?= $student->getLastname() ?>" type="text" class="form-control" id="Lastname" placeholder="nom de l'etudiant'">
        </div>
        <div class="form-group">
            <label for="name">Status</label>
            <input name="status" value="<?= $student->getStatus() ?>" type="text" class="form-control" id="status" placeholder="Status de l'etudiant'">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>