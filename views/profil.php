<!doctype html>

<html>

    <?php include "../includes/head.php"?>

    <body>
        <?php include("../includes/navbar.php");
              require_once "../includes/functions_db.php";
        ?>

        <h1>Username</h1>

        <?php
        // TODO : pseudo quand yaura variable de session !
        $scores = get_all_score('agass');
        ?>


        <div class="choixConteneur">
            <?php
                $i = 0;
                foreach ($scores as $key => $value) {
                    echo "
                        <a class='scoreQuiz' href='descriptionQuiz.php?id=". $scores[$i][0] ."'>
                            <div>" . utf8_encode($scores[$i][1]) ."</div>
                            <div>" . $scores[$i][2] . "</div>
                        </a> ";
                    $i++;
                }
            ?>


        </div>

    </body>

</html>
