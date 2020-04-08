<!doctype html>
<?php session_start();?>

<html>

    <?php
        include "../includes/head.php";
        require_once "../includes/functions_db.php";
        require_once "../includes/functions.php";

        checkConnection();

        if(isset($_POST)) var_dump($_POST);

    ?>

    <body class="no_image">
        <?php
            include("../includes/navbar.php");

            if (isset($_GET['id'])) {
                $quiz = get_quiz($_GET['id']);

                $affichage;
                switch ($quiz[6]){
                    case 1:
                        $affichage = "progressif";
                        break;
                    case 0:
                        $affichage = "bloc";
                        break;
                }
            }
        ?>

        <div class="quizConteneur">
           <?php echo "<h1 class='titre_theme'>" . $quiz[2] . "</h1>
            <div class='desc_theme'>Description : " . $quiz[4] . " </div>"; ?>

            <!-- début du form ici -->

                <?php
                    // affichage si bloc
                    if(strcmp($affichage, "bloc")==0){
                        $questions = get_quizz_questions($_GET['id']);
                        affichageQuizBloc($questions);
                    }

                    // affichage si progressif
                    elseif(strcmp($affichage, "progressif")==0){
                        $idQuiz = $_GET['id'];
                        $numQuestion;
                        if(!isset($_POST["numQuestion"])){
                            $numQuestion = 0;
                        }
                        else{
                            $numQuestion = $_POST["numQuestion"];
                        }

                        affichageQuizProgressif($idQuiz, $numQuestion);
                    }
                ?>


                <button class="btn btn_violet btn_form green" type="submit">Envoyer les réponses </button>

            </form>

        </div>

    </body>

</html>
