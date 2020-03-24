<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php"?>

    <body>
        <?php include("../includes/navbar.php");
              require_once "../includes/functions_db.php";
        ?>

        <?php
        if (isset($_GET['id'])) {
            $quizz = get_all_quizz_per_theme($_GET['id']);
        }
        ?>

        <div class="choixConteneur">
            <?php
                if (count($quizz) > 0) {
                    $i = 0;
                    $green = "green";
                    $purple = "purple";
                    foreach ($quizz as $key => $value) {
                        if ($i%2 == 0) {
                            echo "<a class = 'quizButton green' href='descriptionQuiz.php?id=" . ($i + 1) . "'><h1 class='quizTitre'>" . utf8_encode($quizz[$i][2]) . "</h1>" .
                                "<br><h3 class='quizDescription'>" . utf8_encode($quizz[$i][4]) . "</h3>" .
                                "</a>";
                        }
                        else {
                            echo "<a class = 'quizButton purple' href='descriptionQuiz.php?id=" . ($i + 1) . "'><h1 class='quizTitre'>" . utf8_encode($quizz[$i][2]) . "</h1>" .
                                "<br><h3 class='quizDescription'>" . utf8_encode($quizz[$i][4]) . "</h3>" .
                                "</a>";
                        }
                        $i++;
                    }
                }
                else {
                    echo "Il n'y a pas encore de quizz dans cette catégorie... ";
                }
            ?>
        </div>

    </body>

</html>
