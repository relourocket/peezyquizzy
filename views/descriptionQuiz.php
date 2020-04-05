<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php";
          require_once  "../includes/functions_db.php";
          require_once "../includes/functions.php";

          checkConnection();
    ?>

    <body>
        <?php include("../includes/navbar.php");
            if (isset($_GET['id'])) {
                $quiz = get_quizz_questions($_GET['id']);
            }
            else {
                echo "Pas que quiz sélectionné...";
            }
        ?>

        <div class="descriptionConteneur">
            <?php echo "<h1 class='titre_theme'>" . $quiz[0][2] ."</h1>" ?>
            <?php echo "<div class='desc_theme'>Description : " . $quiz[0][4] ." </div>" ?>

            <div>
                <?php
                    if($_SESSION["isAdmin"]==true){
                        echo "<a class='gererButton purple' href='./accueilAdmin.php'>Gérer</a>";
                    }
                ?>


               <?php echo "<a class='startButton green' href='jouerQuiz.php?id=" . $_GET['id'] . "'>Commencer le Quiz</a>" ?>
            </div>

        </div>

    </body>

</html>
