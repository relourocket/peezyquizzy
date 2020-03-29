<!doctype html>
<?php
    session_start();

    if(isset($_GET["logout"])){
        unset($_SESSION["login"]);
        unset($_SESSION["isAdmin"]);
        header("location: ./index.php");
    }
    else if(isset($_SESSION["login"]) && isset($_SESSION["isAdmin"])){
        header("location: ./choixTheme.php");
    }
?>

<html>

    <?php include "../includes/head.php"?>

    <body class="no_image">

        <?php include("../includes/navbar.php"); ?>

        <img src="../images/quiz.png" class="imageQuiz">

        <div class="flex_column_div">
            <h1 class="bienvenue">Bienvenue sur QuizzyPeezy !</h1>
            <h3 class="desc_accueil">Venez tester vos connaissances sur les thèmes de votre choix grâce à un grand nombre de quiz</h3>
            <div class="boutons_accueil">
                <a class="indexButton green" href="./inscription.php">Créer un compte </a>
                <a class="indexButton purple" href="./connexion.php">Connexion Utilisateur</a>
            </div>

        </div>

    </body>

</html>
