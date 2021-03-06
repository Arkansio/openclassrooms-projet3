<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo WEB_ROOT ?>public/css/bootstrap.min.css" rel="stylesheet" /> 
        <link href="<?php echo WEB_ROOT ?>public/css/style.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="<?php echo WEB_ROOT ?>public/css/animate.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="<?php echo WEB_ROOT ?>public/js/basic.js"></script>
        <script src="<?php echo WEB_ROOT ?>public/js/tinymce/tinymce.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <script>tinymce.init({ selector:'#editor' });</script>
    </head>
        
    <body>
        <?php require('header.php') ?>
        <?= $content ?>
        <a href="<?php echo WEB_ROOT ?>admin" class="adminLog">Admin</a>
    </body>
</html>