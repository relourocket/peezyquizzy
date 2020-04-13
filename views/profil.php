<!doctype html>
<?php session_start();?>

<html>

    <?php
        include "../includes/head.php";
        require_once "../includes/functions_db.php";
        require_once "../includes/functions.php";

        checkConnection();
    ?>

    <body>
        <?php include("../includes/navbar.php");
        ?>

        <h1 class="titre_profil">Vos meilleurs scores</h1>

        <?php
        $scores = get_all_scores_by_user($_SESSION['login']);
        ?>


        <div class="choixConteneur">
            <?php
                $i = 0;
                foreach ($scores as $key => $value) {
                    if ($i%2 == 0) {
                        echo "
                        <a class='scoreQuiz quizButton green' href='descriptionQuiz.php?id=" . $scores[$i][0] . "'>
                            <div class='nom_quiz'>" .$scores[$i][1] . "</div>
                            <div> {$scores[$i][2]} / {$scores[$i][3]} </div>
                        </a> ";
                    }
                    else {
                        echo "
                        <a class='scoreQuiz quizButton purple' href='descriptionQuiz.php?id=" . $scores[$i][0] . "'>
                            <div class='nom_quiz'>" . $scores[$i][1] . "</div>
                            <div>{$scores[$i][2]} / {$scores[$i][3]}</div>
                        </a> ";
                    }
                    $i++;
                }
            ?>

        </div>

    </body>

</html>
