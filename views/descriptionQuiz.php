<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php"?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="descriptionConteneur">
            <h1>Titre</h1>
            <div>Description : blablablablablabla </div>

            <div>
                <?php
                    if($_SESSION["isAdmin"]==true){
                        echo "<a class='gererButton' href='./gererQuiz.php'>Gérer</a>";
                    }
                ?>


               <?php echo "<a class='startButton' href='jouerQuiz.php?id=" . $_GET['id'] . "'>Commencer</a>" ?>
            </div>

        </div>

    </body>

</html>
