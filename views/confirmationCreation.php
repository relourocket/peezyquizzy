<?php session_start()?>
<!doctype html>

<html>


    <?php
          require_once "../includes/functions.php";
          require_once "../includes/functions_db.php";
          include "../includes/head.php";

          checkConnection();
          checkAdmin();

          $ok = false;
          $typeSave;
          if(isset($_POST["questionSeule"])&& isset($_POST["enonceQ0"]) && isset($_POST["typeQuestionQ0"])){
              // saveAllQuestions($_POST);
              $typeSave = "question";
              $ok = true;
          }
          elseif(isset($_POST) && isset($_POST["theme"])){
               // saveQuiz($_POST);
               $typeSave = "quiz";
               $ok = true;
          }

    ?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="confConteneur">
            <?php
                if($ok && strcmp($typeSave, "question") == 0){
                    echo "<h2>Votre question a bien été enregistrée !</h2>";
                    echo "<img src='../images/brent_rambo_court.gif'>";
                }
                elseif($ok && strcmp($typeSave, "quiz")==0){
                    echo "<h2>Votre quiz a bien été enregistrée !</h2>";
                    echo "<img src='../images/brent_rambo_court.gif'>";
                }
                else{
                    echo "<h2>Désolé, un problème est survenu votre question ou quiz n'a pas
                    été sauvegardée :'(</h2>";
                }
             ?>

             <br>
             <a class="btn green btn_retour_admin" href="#">Retour à la page de gestion</a>
        </div>
    </body>
</html>
