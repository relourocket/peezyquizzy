<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php"?>



    <body>
        <?php include("../includes/navbar.php"); ?>


        <!--on importe jquery ici car l'import de bootstrap est la version slim qui ne contient pas load()-->
        <script type="text/javascript" src="../js/jquery_3.4.1.js"></script>
        <script type="text/javascript" src="../js/creerQuiz.js"></script>
        <script type="text/javascript" src="../js/creer_question.js"></script>

        <div class="flex_column_div">
            <h1>Créer un Quiz</h1>

            <form method="post" action="./accueilAdmin.php">
                <!-- informations sur le quizz -->
                <div>
                    <!-- titre -->
                    <div class="form-group row">
                        <label for="titre" class="col-sm-3 col-form-label">Titre <span class="purple_title">*</span></label>
                        <input type="text" name="titre" id="titre" class="form-control col-sm-9" required>
                    </div>

                    <!-- thème -->
                    <div class="form-group row">
                        <label for="theme" class="col-sm-3 col-form-label">Thème <span class="purple_title">*</span></label>
                        <input type="text" name="theme" id="theme" class="form-control col-sm-9" required>
                    </div>

                    <!-- description -->
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description <span class="purple_title">*</span></label>
                        <input type="text" name="description" id="description" class="form-control col-sm-9" required>
                    </div>
                </div>

                <!-- Questions -->
                <p>Les questions de votre nouveau quiz :</p>
                <div id="addQuestion"></div>

                <button  id="addQuestionBtn" class="btn btn_form purple" type="button" onclick="insertQuestion()">Ajouter une question</button>

                <!-- difficulté -->
                <div class="form-group row">
                    <label class="col-sm-5">Difficulté <span class="purple_title">*</span></label>
                    <select class="form-control col-sm-7" name="difficulte">
                        <option value="facile" selected>Facile</option>
                        <option value="moyen">Moyen</option>
                        <option value="difficile">Difficile</option>
                    </select>
                </div>

                <!-- sélection affichage -->
                <div class="form-group row">
                    <p class="col-sm-4">Affichage : <span class="purple_title">*</span></p>
                    <div class="col-sm-2">
                        <label for="bloc">Bloc</label>
                        <input type="radio" id="bloc" name="affichage" value="bloc" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="progressif">Question par question</label>
                        <input type="radio" id="progressif" name="affichage" value="progressif" required>
                    </div>
                </div>

                <!-- nombre de questions -->

                <button class="btn btn_form green" type="submit">Créer le quiz </button>

            </form>


        </div>


    </body>

</html>
