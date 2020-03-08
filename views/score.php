<!doctype html>

<html>

    <?php include "../includes/head.php"?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">
            <h1>Score</h1>

            <table>
                <tr>
                    <td>Votre Score : [score]</td> <td>Meilleur Score : [best score]</td>
                </tr>

                <tr>
                    <td>Votre temps : [temps]</td> <td>Meilleur temps : [best temps]</td>
                </tr>
            </table>
            <div>
                <a class="rejouerButton" href="descriptionQuiz.php?id=#">Rejouer</a>
                <a class="autreQuizButton" href="choixTheme.php">Faire un autre Quiz</a>
            </div>

        </div>

    </body>

</html>
