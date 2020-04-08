<!doctype html>
<?php session_start();?>

<html>

    <?php
        include "../includes/head.php";
        include "../includes/functions_db.php";
        require_once "../includes/functions.php";

        checkConnection();
        checkAdmin();
    ?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="deleteConteneur">
            <?php
                $quiz = get_all_quizz();

                foreach($quiz as $q){
                    $titre = $q[2];
                    $idQuiz = $q[0];
                    $idTheme = $q[1];
                    $theme = get_theme_by_id($idTheme);

                    $themeName = $theme[1];

                    echo "<div class='quizDelete' id='quiz{$idQuiz}'>";
                    echo "<div class='deleteDescription' id='description{$idQuiz}'>
                                <div>Titre : {$titre}</div>    <div>Theme : $themeName</div>
                          </div>
                          <div class='deleteBtn{$idQuiz}'>
                                <button class='btn deleteBtn' onclick='deleteQuiz({$idQuiz})'>Supprimer </button>
                          </div>";
                    echo "</div>";
                }
             ?>
        </div>

    </body>

    <script type="text/javascript" src="../js/delete_quiz.js"></script>
</html>
