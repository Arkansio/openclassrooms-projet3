<?php
$title = 'Interface d\'administration';
?>

<?php ob_start(); ?>

<div class="title_left animated bounceInLeft">
    Panel d'administration
</div>

<div class="container admin">
    <div class="row">
        <div class="col-lg-8">
            <div class="basicForm">
                <h4>Bienvenue sur votre panel d'administration</h1>
                <p class="welcome">
                    Ici vous pouvez administrer votre site internet. Vous avez accès 
                    à différents outils comme la création de billet ou l'administration 
                    des commentaires d'utilisateurs.
                </script></p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="basicForm">
                <a href="<?php echo WEB_ROOT ?>admin/createPost/">
                    <button type="button" class="btn btn-success">Créer un nouveau billet</button>
                </a>
                <a href="<?php echo WEB_ROOT ?>admin/listPosts/">
                    <button type="button" class="btn btn-info">Voir tous les billets</button>
                </a>
            </div>
            <div class="basicForm bottom">
                <a href="<?php echo WEB_ROOT ?>admin/flagComments/">
                    <button type="button" class="btn btn-warning">Commentaires signalés</button>
                </a>
                <a href="<?php echo WEB_ROOT ?>admin/listComments/">
                    <button type="button" class="btn btn-info">Tous les commentaires</button>
                </a>
            </div>
            <div class="basicForm bottom">
                <a href="<?php echo WEB_ROOT ?>logout/">
                    <button type="button" class="btn btn-danger">Déconnexion</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
