<div class="container my-4">
        <div class="card card--signin">
            <div class="card-header">
                Connexion
                <!-- inclusion d'une template pour gérer les messages d'erreurs -->
            <?php
                // On inclut des sous-vues => "partials"
                include __DIR__ . '/../partials/errors.tpl.php';
            ?>
            </div>
            <div class="card-body">
                <form action="<?= $router->generate('signin_post') ?>" method="post">
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Saisissez votre adresse email" value="">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Saisissez votre mot de passe" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-4">se connecter</button>
                </form>
            </div>
        </div>
</div>