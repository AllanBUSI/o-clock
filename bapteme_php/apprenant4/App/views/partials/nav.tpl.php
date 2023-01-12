<?php //dump($viewData); ?>



    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand"  href="<?= $router->generate('main-home') ?>">Skoule</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link"<?php if($viewData["currentPage"] == "main/home") echo "active"; ?>" href="<?= $router->generate('main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= md5(time()) ?>">404</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php if($viewData["currentPage"] == "teachers/teachers_list") echo "active"; ?>" href="<?= $router->generate('teachers') ?>">Profs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  <?php if($viewData["currentPage"] == "students/students_list") echo "active"; ?>" href="<?= $router->generate('students') ?>">Etudiants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php if($viewData["currentPage"] == "appusers/appusers_list") echo "active"; ?>" href="<?= $router->generate('appusers') ?>">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php if($viewData["currentPage"] == "appusers/login") echo "active"; ?>" href="<?= $router->generate('login') ?>">Se déconnecter</a>
                    </li>

                    <?php if(isset($_SESSION['userId'])): ?>
                    <li>
                        <a class="nav-link" href="<?= $router->generate('user_list') ?>">Utilisateurs</a>
                    </li>
                    <li>
                        <a class="nav-link" href="<?= $router->generate('user_logout') ?>">Deconnexion</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="nav-link" href="<?= $router->generate('user_login') ?>">Connexion</a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        <p class="display-5">
            Bienvenue dans le backOffice <strong>d'une école 100% en ligne formant des développeurs Web</strong>...
        </p>
    </div>

    