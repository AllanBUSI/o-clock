<div class="container my-4">
    <a href="<?= $router->generate('students') ?>" class="btn btn-success float-end">Retour</a>
    <h2>Ajouter un student</h2>

    <!-- inclusion d'une template pour gérer les messages d'erreurs -->
    <?php
        // On inclut des sous-vues => "partials"
        include __DIR__ . '/../partials/errors.tpl.php';
    ?>
    
    <form action="<?= $router->generate('students_add') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Firstname</label>
            <input name="firstname" value="<?= $student->getFirstame() ?>" type="text" class="form-control" id="Firstname" placeholder="prenom de l'etudiant">
        </div>

        <form action="<?= $router->generate('students_add') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Firstom</label>
            <input name="Lastname" value="<?= $student->getLastame() ?>" type="text" class="form-control" id="Lastname" placeholder="nom de l'etudiant">
        </div>
        

        <form action="<?= $router->generate('students_add') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Firstom</label>
            <input name="status" value="<?= $student->getStatus() ?>" type="text" class="form-control" id="status" placeholder="status de l'etudiant">
        </div>
        
        
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>