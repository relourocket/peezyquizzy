<!doctype html>
<?php session_start();?>

<?php include("../includes/navbar.php");
      require_once "../includes/functions_db.php";
      require_once "../includes/functions.php";

      checkConnection();
?>

<html>

    <?php include "../includes/head.php"?>

    <body>


        <?php
        if (isset($_GET['id'])) {
            $quiz = get_all_quizz_per_theme($_GET['id']);
            $theme = get_theme_by_id($_GET['id']);
        }
        ?>

        <h1 class="titre_centre_div">Quiz du thème <?php echo $theme[1];?></h1>
        <div class="choixConteneur">
            <?php
                if (count($quiz) > 0) {
                    $i = 0;
                    $green = "green";
                    $purple = "purple";
                    foreach ($quiz as $key => $value) {
                        $quizID = $quiz[$i][0];
                        $quizTitre = $quiz[$i][2];
                        $quizDescription = $quiz[$i][4];

                        if ($i%2 == 0) {
                            echo "<a class = 'quizButton green' href='descriptionQuiz.php?id=" . $quizID . "'><h1 class='quizTitre'>" . $quizTitre . "</h1>" .
                                "<br><h3 class='quizDescription'>" . $quizDescription . "</h3>" .
                                "</a>";
                        }
                        else {
                            echo "<a class = 'quizButton purple' href='descriptionQuiz.php?id=" . $quizID . "'><h1 class='quizTitre'>" . $quizTitre . "</h1>" .
                                "<br><h3 class='quizDescription'>" . $quizDescription . "</h3>" .
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
