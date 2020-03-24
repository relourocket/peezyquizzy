<!doctype html>
<?php session_start();?>

<html>

    <?php
        include "../includes/head.php";
        include "../includes/functions_db.php";
    ?>
    <?php
        //TO DO : fonctions pour insérer en bdd questionnaire/questions/rep

      //   if (isset($_POST['enonce']) && isset($_POST['type_question']) &&
      //       isset($_POST['rep']) && isset($_POST['rep1']) &&
      //       isset($_POST['rep2'])  && isset($_POST['rep3']) &&
      //       isset($_POST['rep4'])  && isset($_POST['rep5']) &&
      //       isset($_POST['rep6'])  && isset($_POST['rep7']) &&
      //       isset($_POST['rep8'])) {
      //
      //           save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
      //                 $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], $_POST["juste"]);
      // }
      //
      //
      //   }

      // if(isset($_POST)) echo var_dump($_POST);
      if(isset($_FILES)) echo var_dump($_FILES);
     ?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">
            <h1>Wesh Admin</h1>

            <a class="indexButton" href="../includes/creerQuestion.php">Créer une Question </a>
            <a class="indexButton" href="./creerQuiz.php">Créer un Quiz</a>
            <a class="indexButton" href="./choixTheme.php">Gérer un Quiz</a>
            <a class="indexButton" href="./gererUsers.php">Gérer les Utilisateurs</a>

        </div>

    </body>

</html>
