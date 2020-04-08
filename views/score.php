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

        <div class="flex_column_div">

            <?php
            if (isset($_POST) && isset($_SESSION['login'])) {
                if(isset($_POST['numQuestion'])) unset($_POST['numQuestion']);

                $scores = get_score3($_POST);
                $scoreJoueur = $scores[0];
                $scoreMaxPossible = $scores[1];

                // TODO : temps
                save_score ($scoreJoueur, 0, $_POST['idquizz'], $_SESSION['login']);
                $best_score = get_best_score($_SESSION['login'], $_POST["idquizz"]);
                $best_time = get_best_time($_SESSION['login']);
            }
            else {
                echo "Il n'y a pas de réponses enregistrées pour ce quizz";
            }
            ?>
            <h1>Score</h1>

            <table>
                <tr>
                    <td class="purple_title">Votre Score : <?php  echo "$scoreJoueur / $scoreMaxPossible"?></td> <td class="purple_title"> Meilleur Score : <?php echo "$best_score / $scoreMaxPossible" ?></td>
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
