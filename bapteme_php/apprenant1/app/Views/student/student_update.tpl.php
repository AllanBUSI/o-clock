<?php $student = $viewData["student"] ?>
<div class="container my-4"> <a href="<?= $router->generate('student_list') ?>" class="btn btn-success float-right">Retour</a>
        <h2>Mettre à jour un étudiant</h2>
        <!-- inclusion d'une template pour gérer les messages d'erreurs -->
    <?php
        // On inclut des sous-vues => "partials"
        include __DIR__ . '/../partials/errors.tpl.php';
    ?>

        <form action="<?= $router->generate('student_update_post') ?>" method="POST" class="mt-5">
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?= $student->getFirstname() ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="<?= $student->getLastname() ?>">
            </div>
            <div class="form-group">
                <label for="teacher">Prof</label>
                <select name="teacher" id="teacher" class="form-control">
                <option value="<?= $student->getTeacher_id() ?>">-</option>
                    <?php foreach($viewData["teachers"] as $teacher): ?>
                        <option value="<?= $teacher->getId() ?>"><?= $teacher->getFirstname() ?> - <?= $teacher->getJob() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control">
                    <option value="0">-</option>
                    <option value="1" selected>actif</option>
                    <option value="2">désactivé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>