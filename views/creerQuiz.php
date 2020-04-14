<!doctype html>
<?php session_start();?>

<html>

    <?php
        include "../includes/head.php";
        include "../includes/functions_db.php";
        include "../includes/functions.php";

        checkConnection();
        checkAdmin();
    ?>



    <body>
        <?php include("../includes/navbar.php"); ?>


        <!--on importe jquery ici car l'import de bootstrap est la version slim qui ne contient pas load()-->
        <script type="text/javascript" src="../js/jquery_3.4.1.js"></script>
        <script type="text/javascript" src="../js/creerQuiz.js"></script>

        <div class="flex_column_div">
            <h1>Créer un Quiz</h1>

            <form method="post" action="./confirmationCreation.php" onsubmit="return checkForm()" enctype="multipart/form-data">

                <!-- informations sur le quizz -->
                <div>
                    <!-- titre -->
                    <div class="form-group row">
                        <label for="titre" class="col-sm-3 col-form-label">Titre <span class="purple_title">*</span></label>
                        <input type="text" name="titre" id="titre" class="form-control col-sm-9" required>
                    </div>


                    <!-- description -->
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description Quiz</label>
                        <input type="text" name="description" id="description" class="form-control col-sm-9" required>
                    </div>

                    <!-- thème -->
                    <div id="theme" class="form-group row">
                        <label for="themeSelect" class="col-sm-3 col-form-label">Thème</label>
                        <select name="theme" id=themeSelect class="form-control col-sm-9" onchange="selectTheme()" required>
                            <option value="" selected disabled>-- Choix du Thème --</option>
                            <option value='nouveau'>Nouveau Thème</option>
                            <?php
                                insert_theme_options();
                            ?>
                        </select>
                    </div>


                </div>

                <!-- Questions -->

                <!-- conteneur où sont insérés tous les éléments d'une question -->

                <p>Les questions de votre nouveau quiz :</p>
                <div id="addQuestion"></div>

                <script type="text/javascript">
                    let i;
                    for(i =0; i < 10; i++){
                        insertQuestion();
                    }

                </script>

                <button  id="addQuestionBtn" class="btn btn_form purple" type="button" onclick="insertQuestion()">Ajouter une question</button>

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


                <button class="btn btn_form green" type="submit">Créer le quiz </button>

                <!-- div pour afficher qu'il y a une erreur -->
                <div id="erreur"></div>

            </form>


        </div>


    </body>

</html>
