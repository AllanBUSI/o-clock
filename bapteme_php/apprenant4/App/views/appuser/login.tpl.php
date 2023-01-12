<div class="container my-4">
    <h2>Login</h2>

    <?php
        // On inclut des sous-vues => "partials"
        include __DIR__ . '/../partials/errors.tpl.php';
    ?>
    <form action="<?= $router->generate('user_login') ?>" method="post" class="mt-5">
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" id="email" value="nicole@oclock.io">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input name="password" type="password" class="form-control" id="password" value="onews">
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Connexion</button>
    </form>
</div>