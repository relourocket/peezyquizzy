<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php"?>

    <body>

        <?php include("../includes/navbar.php");
              require_once "../includes/functions_db.php";
        ?>

        <div class="flex_column_div">

            <?php
            if (isset($_POST) && isset($_SESSION['login'])) {
                $score = get_score ($_POST);

                // TODO : temps
                save_score ($score, 0, $_POST['idquizz'], $_SESSION['login']);
                $best_score = get_best_score($_SESSION['login']);
                $best_time = get_best_time($_SESSION['login']);
            }
            else {
                echo "Il n'y a pas de réponses enregistrées pour ce quizz";
            }
            ?>
            <h1>Score</h1>

            <table>
                <tr>
                    <td>Votre Score : <?php  echo $score?></td> <td>Meilleur Score : <?php echo $best_score ?></td>
                </tr>

                <tr>
                    <td>Votre temps : [temps]</td> <td>Meilleur temps : <?php  if ($best_time > 0) echo $best_time ?></td>
                </tr>
            </table>
            <div>
                <a class="rejouerButton" href="descriptionQuiz.php?id=<?php echo $_POST['idquizz'] ?>">Rejouer</a>
                <a class="autreQuizButton" href="choixTheme.php">Faire un autre Quiz</a>
            </div>

        </div>

    </body>

</html>
