<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= $router->generate('main-home') ?>">Skoule</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <?php if(isset($_SESSION['userId'])): ?>
                    <li class="nav-item <?php if($viewData["currentPage"] == "main/home") echo "active"; ?>">
                        <a class="nav-link" href="<?= $router->generate('main-home') ?>">Accueil</a>
                    </li>
                    <li class="nav-item <?php if($viewData["currentPage"] == "teacher/teacher_list") echo "active"; ?> <?php if($viewData["currentPage"] == "teacher/teacher_add") echo "active"; ?>">
                        <a class="nav-link" href="<?= $router->generate('teacher_list') ?>">Profs</a>
                    </li>
                    <li class="nav-item <?php if($viewData["currentPage"] == "student/student_list") echo "active"; ?> <?php if($viewData["currentPage"] == "student/student_add") echo "active"; ?>">
                        <a class="nav-link" href="<?= $router->generate('student_list') ?>">Etudiants</a>
                    </li>
                    <li class="nav-item <?php if($viewData["currentPage"] == "user/user_list") echo "active"; ?>">
                        <a class="nav-link" href="<?= $router->generate('user_list') ?>">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('user_logout') ?>">Se déconnecter</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item <?php if($viewData["currentPage"] == "/signin_get") echo "active"; ?>">
                        <a class="nav-link" href="<?= $router->generate('signin_get') ?>">Se connecter</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>