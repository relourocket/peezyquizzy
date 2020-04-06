<?php session_start();


include "../includes/head.php";
include "../includes/functions_db.php";
include "../includes/functions.php";

checkConnection();
checkAdmin();
?>

<?php
    if(isset($_POST) && isset($_POST["theme"])) saveQuiz($_POST);
 ?>

<!doctype html>
<html>
    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">
            <h1 class="titre_admin">Accueil de la gestion des quiz</h1>
            <h3 class="desc_admin">Choisissez ce que vous souhaitez faire</h3>

            <div class="admin_boutons">
                <a class="indexButton green" href="../includes/creerQuestion.php">Créer une Question </a>
                <a class="indexButton green" href="./creerQuiz.php">Créer un Quiz</a>
                <a class="indexButton purple" href="./deleteQuiz.php">Effacer un Quiz</a>
                <a class="indexButton purple" href="./gererUsers.php">Gérer les Utilisateurs</a>
            </div>

        </div>

    </body>

</html>
