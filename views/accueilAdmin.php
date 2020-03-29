<?php session_start();

include "../includes/head.php";
include "../includes/functions_db.php";
include "../includes/functions.php";
?>

<?php
    if(isset($_POST)) saveQuiz($_POST);
 ?>
 
<!doctype html>
<html>
    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">
            <h1>Wesh Admin</h1>

            <a class="indexButton" href="../includes/creerQuestion.php">Créer une Question </a>
            <a class="indexButton" href="./creerQuiz.php">Créer un Quiz</a>
            <a class="indexButton" href="./choixTheme.php">Gérer un Quiz</a>
            <a class="indexButton" href="./gererUsers.php">Gérer les Utilisateurs</a>

        </div>

    </body>

</html>
