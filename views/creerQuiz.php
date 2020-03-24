<!doctype html>
<?php session_start();?>

<html>

    <?php
        include "../includes/head.php";
        include "../includes/functions_db.php";
        include "../includes/functions.php";
    ?>



    <body>
        <?php include("../includes/navbar.php"); ?>


        <!--on importe jquery ici car l'import de bootstrap est la version slim qui ne contient pas load()-->
        <script type="text/javascript" src="../js/jquery_3.4.1.js"></script>
        <script type="text/javascript" src="../js/creerQuiz.js"></script>

        <div class="flex_column_div">
            <h1>Créer un Quiz</h1>

            <form method="post" action="./accueilAdmin.php" enctype="multipart/form-data">
                <!-- informations sur le quizz -->
                <div>
                    <!-- titre -->
                    <div class="form-group row">
                        <label for="titre" class="col-sm-3 col-form-label">Titre</label>
                        <input type="text" name="titre" id="titre" class="form-control col-sm-9" required>
                    </div>

                    <!-- description -->
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description Quiz</label>
                        <input type="text" name="description" id="description" class="form-control col-sm-9" required>
                    </div>

                    <!-- thème -->
                    <div id="theme" class="form-group row">
                        <label for="theme" class="col-sm-3 col-form-label">Thème</label>
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
                <div id="addQuestion"></div>

                <button  id="addQuestionBtn" class="btn" type="button" onclick="insertQuestion()">Ajouter</button>

                <!-- difficulté -->
                <div class="form-group row">
                    <label for ="difficulte" class="col-sm-5">Difficulté</label>
                    <select id="difficulte" name="difficulte" class="form-control col-sm-7" >
                        <option value="facile" selected>Facile</option>
                        <option value="moyen">Moyen</option>
                        <option value="difficile">Difficile</option>
                    </select>
                </div>

                <!-- sélection affichage -->
                <div class="form-group row">
                    <p class="col-sm-4">Affichage :</p>
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

                <button class="btn" type="submit">Envoyer </button>

            </form>


        </div>


    </body>

</html>
