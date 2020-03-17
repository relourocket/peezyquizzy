<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php"?>



    <body>
        <?php include("../includes/navbar.php"); ?>

        <!--on importe jquery ici car l'import de bootstrap est la version slim qui ne contient pas load()-->
        <script type="text/javascript" src="../js/jquery_3.4.1.js"></script>
        <script type="text/javascript">

            function insertQuestion(){
                //le tricks ici c'est de créer un élément que l'on peut sélectionner
                //avec jquery pour utiliser la fonction load()
                let questionDiv = $("#addQuestion");
                let newQuestion = document.createElement("div");
                newQuestion.setAttribute("class", "question");

                //on assigne des id de question pour pouvoir les sélectionner pour les effacer
                let questionID = "q".concat($(".question").length);
                newQuestion.setAttribute("id", questionID);
                questionDiv.append(newQuestion);

                //load() récupère du code html depuis un autre fichier
                $(".question").last().load("../includes/creerQuestion.php");

                //création du bouton pour remove la question
                let removeBtn = document.createElement("button");
                removeBtn.innerHTML = "Effacer la question";
                removeBtn.setAttribute("class", "removeBtn");
                removeBtn.setAttribute("id", "removeBtn".concat(questionID));
                removeBtn.setAttribute("onclick", `removeQuestion('${questionID}')`);

                //on met un type button pour empêcher de submit à l'appui
                removeBtn.setAttribute("type", "button");

                //append le boutton à la question
                $("#addQuestion").append(removeBtn);
            }

            function removeQuestion(questionID){
                    $("#".concat(questionID)).remove();
                    $("#removeBtn".concat(questionID)).remove();
            }

        </script>

        <div class="descriptionConteneur">
            <h1>Créer un Quiz</h1>



            <form method="post" action="#">
                <div id="addQuestion">
                </div>

                <button  class="btn" type="button" onclick="insertQuestion()">Ajouter</button>
                <button class="btn" type="submit">Envoyer </button>

            </form>


        </div>
    </body>

</html>
