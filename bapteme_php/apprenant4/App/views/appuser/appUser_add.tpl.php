<div class="container my-4">
    <a href="<?= $router->generate('appUser_list') ?>" class="btn btn-success float-end">Retour</a>
    <h2>Ajouter un utilisateur</h2>

    <?php
        // On inclut des sous-vues => "partials"
        include __DIR__ . '/../partials/errors.tpl.php';
    ?>

    <form action="<?= $router->generate('AppUser_add') ?>" method="POST" class="mt-5">
        <input type="hidden" name="token" value="<?= $CSRF ?>">
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" id="email" value="toto@toto.fr">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input name="password" type="password" class="form-control" id="password" value="toto">
        </div>
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input name="firstname" type="text" class="form-control" id="firstname" value="toto">
        </div>
        <div class="form-group">
            <label for="lastname">Nom de famille</label>
            <input name="lastname" type="text" class="form-control" id="lastname" value="Famille">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="user-role">
                <option value="">Choisissez un rôle</option>
                <option value="admin">Administrateur</option>
                <option value="user">user</option>
                <option value="user">empty</option>
            </select>
            <small id="rateHelpBlock" class="form-text text-muted">
                Le rôle de l'utilisateur
            </small>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="user-status">
                <option value="">-</option>
                <option value="actif">Actif</option>
                <option value="disabled">Désactivé</option>
            </select>
            <small id="rateHelpBlock" class="form-text text-muted">
                Le statut de l'utilisateur
            </small>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>