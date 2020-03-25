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
                    <td class="purple_title">Votre Score : <?php  echo $score?></td> <td class="purple_title"> Meilleur Score : <?php echo $best_score ?></td>
                </tr>

                <tr>
                    <td class="green_title">Votre temps : [temps]</td> <td class="green_title"> Meilleur temps : <?php  if ($best_time > 0) echo $best_time ?></td>
                </tr>
            </table>
            <div>
                <a class="indexButton green" href="descriptionQuiz.php?id=<?php echo $_POST['idquizz'] ?>">Rejouer</a>
                <a class="indexButton purple" href="choixTheme.php">Faire un autre Quiz</a>
            </div>

        </div>

    </body>

</html>
