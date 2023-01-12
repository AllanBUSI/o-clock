<div class="container my-4">
    <a href="<?= $router->generate('teachers') ?>" class="btn btn-success float-end">Retour</a>
    <h2>Ajouter un teacher</h2>

    <!-- inclusion d'une template pour gérer les messages d'erreurs -->
    <?php
        // On inclut des sous-vues => "partials"
        include __DIR__ . '/../partials/errors.tpl.php';
    ?>
    
    <form action="<?= $router->generate('teachers_add') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Firstname</label>
            <input name="firstname" value="<?= $teacher->getFirstame() ?>" type="text" class="form-control" id="Firstname" placeholder="prenom de l'enseignant">
        </div>

        <form action="<?= $router->generate('teachers_add') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Lastname</label>
            <input name="Lastname" value="<?= $teacher->getLastame() ?>" type="text" class="form-control" id="Lastname" placeholder="nom de l'enseignant">
        </div>
        
        <form action="<?= $router->generate('teachers_add') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Job</label>
            <input name="job" value="<?= $teacher->getJob() ?>" type="text" class="form-control" id="job" placeholder="Job de l'enseignant">

        <form action="<?= $router->generate('teachers_add') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Status</label>
            <input name="status" value="<?= $teacher->getStatus() ?>" type="text" class="form-control" id="status" placeholder="status de l'enseignant">
        </div>
        
        
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>