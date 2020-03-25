<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php"?>

    <body class="no_image">
        <?php include("../includes/navbar.php");
              require_once "../includes/functions_db.php";
        ?>

        <?php
        if (isset($_GET['id'])) {
            $questions = get_quizz_questions($_GET['id']);
        }
        ?>

        <div class="quizConteneur">
           <?php echo "<h1 class='titre_theme'>" . $questions[0][2] . "</h1>
            <div class='desc_theme'>Description : " . $questions[0][4] . " </div>" ?>

            <form method="post" action="./score.php" class="quizForm">

                <?php
                    $i = 0; //index pour la question
                    $indexRadio = 0; //index pour répertorier les radios correctement
                    foreach ($questions as $key => $value) {
                        $answers = get_answers($i+1);
                        echo "<label class='question' for='question" .$i ."'> <span class='purple_title'>" .  $questions[$i][12] . ". </span>" . $questions[$i][9] . "</label>";
                        if (strcmp($answers[0][1], "libre") == 0) {
                            echo "<input type='text' id='question" .$i ."' name='". $i ."'>";
                        }
                        else if (strcmp($answers[0][1], "radio") == 0) {
                            $j = 0; //index des réponses pour les radios
                            foreach ($answers as $key2 => $value2) {
                                echo "<div>
                                          <input type='radio' name='" . $i . "' id='rep" .$indexRadio ."'value= '" . $answers[$j][4] . "'>
                                          <label for= 'rep" .$indexRadio ."'>". $answers[$j][4] ."</label>
                                    </div>";
                                $j++;
                                $indexRadio++;
                            }
                        }
                        $i++;
                    }

                    echo "<input type='hidden' name='idquizz' value='" .$_GET["id"] ."'>";
                ?>


                <button class="btn btn_form green" type="submit">Envoyer les réponses </button>

            </form>

        </div>

    </body>

</html>
