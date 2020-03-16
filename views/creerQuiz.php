<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php"?>



    <body>
        <?php include("../includes/navbar.php"); ?>
        <script type="text/javascript" src="../js/jquery_3.4.1.js"></script>
        <script type="text/javascript">
            function insert(){
                var cible = document.getElementById("addQuestion");
                cible.insertAdjacentHTML("beforeend", "<div>bonjour les zamis</div>");
            }

            function insert2(){
                $("#addQuestion").load("../includes/creerQuestion.php");
            }

        </script>

        <div class="descriptionConteneur">
            <h1>Créer un Quiz</h1>



            <form method="post" action="#">
                <div id="addQuestion">
                </div>

                <button  class="btn" type="button" onclick="insert2()">Ajouter</button>
                <button class="btn" type="submit">Envoyer </button>

            </form>


        </div>
    </body>

</html>
