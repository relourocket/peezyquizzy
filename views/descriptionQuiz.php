<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php";
          require_once  "../includes/functions_db.php";
          require_once "../includes/functions.php";

          checkConnection();
    ?>

    <body>
        <?php include("../includes/navbar.php");
            if (isset($_GET['id'])) {
                $quiz = get_quizz_questions($_GET['id']);
            }
            else {
                echo "Pas que quiz sélectionné...";
            }
        ?>

        <div class="descriptionConteneur">

            <?php
                echo "<h1 class='titre_theme'>" . $quiz[0][2] ."</h1>";
                echo "<div class='desc_theme'>Description : " . $quiz[0][4] ." </div>";
                echo "<form method='POST'action='jouerQuiz.php?id={$_GET["id"]}'"
             ?>

                <div>
                    <div class="form-group row">
                        <label class="form-label col-sm-6" for="facile">Facile</label>
                        <input type="radio" name="difficulte" value="facile" id="facile" required>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-6" for="moyen">Moyen</label>
                        <input type="radio" name="difficulte" value="moyen" id="moyen" required>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-6" for="difficile">Difficile</label>
                        <input type="radio" name="difficulte" value="difficile" id="difficile" required>
                    </div>

                    <div class="row">
                        <?php
                            if($_SESSION["isAdmin"]==true){
                                echo "<a class='gererButton purple' href='./accueilAdmin.php'>Gérer</a>";
                            }
                        ?>

                       <?php
                            echo "<button class='btn green startButton' type='submit'>Jouer</button>";
                        ?>
                    </div>

                </div>
            </form>
        </div>


    </body>

</html>
