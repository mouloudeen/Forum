<?php
/**
 * Example of page using this template :
 * <?php $title = 'Forum'; ?>
 *<?php ob_start(); ?>
 *<h1>Bienvenue sur le forum !</h1>
 *<p>Pensez à vous connecter.</p>
 *<?php $content = ob_get_clean(); ?>

 *<?php require('../template.php'); ?>
 *
*/
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <!-- Load BootStrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <style>
            .navbar-nav {
            flex-direction: row;
            }

            .nav-link {
            padding-right: .5rem !important;
            padding-left: .5rem !important;
            }
        </style>
   </head>

    <body>
    <ul class="navbar justify-content-end navbar-expand-sm bg-dark navbar-dark">
        <li class="nav-item navbar-nav mr-auto">
            <p class="navbar-brand">
              <form action="./" method="POST">
                <input name="forum_user" type="hidden" value="<?php echo $_SESSION["user_number"]; ?>"/>
                <button name="forum_page" type="submit" class="btn btn-link " value="1"> Accueil </button>
              </form>
            </p>
        </li>
        <?php if($_SESSION["admin"]){
          echo "<form action='./' method='POST'>";
          echo '<input name="report_page_t" type="hidden" value="1"/>';
          echo '<button name="report_page" type="submit" class="btn btn-link "value="1"> Signalements </button>';
          echo '</form>';
        } ?>
            <form action="./" method="POST">
              <button name="param" type="submit" class="btn btn-link " value="param"> Paramètres </button>
            </form>
        <!--<a class="nav-link" href="./">Deconnexion</a>-->
        <form action="./" method="POST">
          <button name="disconnect" type="submit" class="btn btn-link" value="disconnect">Deconnexion</button>
        </form>
      </ul>

        <?= $content ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
