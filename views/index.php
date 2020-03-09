<!doctype html>
<?php
    session_start();

    if(isset($_GET["logout"])){
        unset($_SESSION["login"]);
        unset($_SESSION["isAdmin"]);
        header("location: ./index.php");
    }
?>

<html>

    <?php include "../includes/head.php"?>

    <body>

        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">
            <h1>Bienvenue sur QuizzyPeezy !</h1>

            <a class="indexButton" href="./inscription.php">Créer un compte </a>
            <a class="indexButton" href="./connexion.php">Connexion Utilisateur</a>
            <a class="indexButton" href="./connexion.php">Connexion Admin</a>

        </div>

    </body>

</html>
