<?php if(!empty($viewData["errors"])): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach($viewData["errors"] as $error): ?>
            <div><?= $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>