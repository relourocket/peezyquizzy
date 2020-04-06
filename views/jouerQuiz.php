<!doctype html>
<?php session_start();?>

<html>

    <?php
        include "../includes/head.php";
        require_once "../includes/functions_db.php";
        require_once "../includes/functions.php";

        checkConnection();
    ?>

    <body class="no_image">
        <?php include("../includes/navbar.php");

        ?>

        <?php
        if (isset($_GET['id'])) {
            $questions = get_quizz_questions($_GET['id']);
        }
        ?>

        <div class="quizConteneur">
           <?php echo "<h1 class='titre_theme'>" . $questions[0][2] . "</h1>
            <div class='desc_theme'>Description : " . $questions[0][4] . " </div>"; ?>

            <form method="post" action="./score.php" class="quizForm">

                <?php
                    $indexRadio = 0; //index pour répertorier les radios correctement
                    $nbQuestion;

                    foreach ($questions as $q) {
                        $idQuestion = $q[7];

                        switch ($q[6]){
                            case 1:
                                $affichage = "progressif";
                            case 0:
                                $affichage = "bloc";
                        }

                        switch ($q[5]){
                            case 1:
                                $difficulte = "facile";
                                $nbQuestion = 3;
                                break;
                            case 2:
                                $difficulte = "moyen";
                                $nbQuestion = 5;
                                break;
                            case 3:
                                $difficulte = "difficile";
                                $nbQuestion = 8;
                                break;

                        }

                        $answers = get_answers($idQuestion);
                        $numeroQuestion = $q[12];
                        $enonceQuestion = $q[9];

                        echo "<label class='question' for='question" .$numeroQuestion ."'> <span class='purple_title'>" .  $numeroQuestion . ". </span>" . $enonceQuestion . "</label>";

                        if (strcmp($answers[0][1], "libre") == 0) {
                            echo "<input type='text' id='question" .$numeroQuestion ."' name='". $numeroQuestion ."'>";
                            echo "<br>";
                        }
                        else if (strcmp($answers[0][1], "radio") == 0) {

                            $indexUtilise = array();
                            $nbUtilise = 1;

                            // on trouve la réponse juste
                            for($iAnswer = 0; $iAnswer < sizeof($answers); $iAnswer++){
                                if($answers[$iAnswer][5]==1){
                                    array_push($indexUtilise, $iAnswer);
                                }
                            }
                            while($nbUtilise < $nbQuestion){
                                $rng = rand(0, sizeof($answers)-1); //borne supérieure inclusive

                                if(!in_array($rng, $indexUtilise)){
                                    array_push($indexUtilise, $rng);
                                    $nbUtilise++;
                                }
                            }
                            
                            // aléatorisation des réponses
                            shuffle($indexUtilise);

                            foreach ($indexUtilise as $i) {
                                echo "<div>
                                          <input type='radio' name='" . $numeroQuestion . "' id='rep" .$indexRadio ."'value= '" . $answers[$i][4] . "'>
                                          <label for= 'rep" .$indexRadio ."'>". $answers[$i][4] ."</label>
                                    </div>";
                                $indexRadio++;
                            }
                        }
                    }

                    echo "<input type='hidden' name='idquizz' value='" .$_GET["id"] ."'>";
                ?>


                <button class="btn btn_form green" type="submit">Envoyer les réponses </button>

            </form>

        </div>

    </body>

</html>
