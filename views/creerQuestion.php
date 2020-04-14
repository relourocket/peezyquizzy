<?php session_start()?>
<!doctype html>

<html>


    <?php
          require_once "../includes/functions.php";
          require_once "../includes/functions_db.php";
          include "../includes/head.php";

          checkConnection();
          checkAdmin();
    ?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <script type="text/javascript" src="../js/jquery_3.4.1.js"></script>
        <script type="text/javascript" src="../js/creerQuestion.js"></script>

        <div class="conteneurQuestion">
            <div id="createQuestionDescription">
                <h2>Création de question</h2>
                <div>
                    Vous pouvez ici créer une question. En créant par la suite un quiz,
                    vous pourrez choisir d'inclure votre question dedans.
                </div>
            </div>

            <form method="post" action="./confirmationCreation.php">

                <div id="createQuestionQ0">
                </div>

                <input type="hidden" name="questionSeule" value="true">

                <button class="btn btn_form green" type="submit">Créer la question</button>
            </form>

        </div>
    </body>
</html>
