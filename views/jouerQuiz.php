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
            $questions = get_quizz_questions($_GET['id']);
        }
        ?>

        <div class="descriptionConteneur">
           <?php  echo "<h1>" . utf8_encode($questions[0][2]) . "</h1>
            <div>Description : " . utf8_encode($questions[0][4]) . " </div>" ?>

            <form method="post" action="./score.php" class="quizForm">

                <?php
                    $i = 0;
                    $indexRadio = 0; //index pour répertorier les radios correctement
                    foreach ($questions as $key => $value) {
                    $answers = get_answers($i+1);
                    echo "<label for='question" .$i ."'>" .  utf8_encode($questions[$i][12]) . "." . utf8_encode($questions[$i][9]) . "</label>";
                    if (strcmp($answers[0][1], "libre") == 0) {
                        echo "<input type='text' id='question" .$i ."'>";
                    }
                    else if (strcmp($answers[0][1], "radio") == 0) {
                        $j = 0;
                        foreach ($answers as $key2 => $value2) {
                            echo "<div>
                                      <input type='radio' name='" . $i . "' id='rep" .$indexRadio ."'value= '" . utf8_encode($answers[$j][3]) . "'>
                                      <label for= 'rep" .$indexRadio ."'>". utf8_encode($answers[$j][4]) ."</label>
                                </div>";
                            $j++;
                            $indexRadio++;
                        }
                    }
                    $i++;
                    }
                ?>

                <button class="btn" type="submit">Envoyer </button>

            </form>

        </div>

    </body>

</html>
