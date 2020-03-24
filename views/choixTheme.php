<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php";
          require_once "../includes/functions_db.php";
    ?>

    <body>
        <?php
        require_once "../includes/functions_db.php";



        //traitement lors de la connexion au compte
        if (isset($_POST['login']) && isset($_POST['mdp'])) {
            if (!pseudo_exists($_POST['login'])) {
                echo "Pseudo existe pas";
                header('location: ./connexion.php?error=2');
            }
            else if(!check_logs($_POST['login'], $_POST['mdp'])) {
                header('location: ./connexion.php?error=1');
            }
            else if(is_admin($_POST['login'])){
                $_SESSION["login"] = $_POST["login"];
                $_SESSION["isAdmin"] = true;
            }
            else{
                $_SESSION["login"] = $_POST["login"];
                $_SESSION["isAdmin"] = false;
            }
        }

        ?>
        <?php include("../includes/navbar.php");
              $themes = get_all_themes();
        ?>

        <div class="choixConteneurTheme">

            <?php
            $i = 0;
            foreach ($themes as $key => $value) {
                if($i%2==0) {
                    echo "<a class = 'themeButton' href='choixQuiz.php?id=".($i+1)."'>
                    <h1 class='titre_theme green_title'>" . utf8_encode($themes[$i][1]) . "</h1>" .
                        "<h3 class='desc_theme'>" . utf8_encode($themes[$i][2]) . "</h3>" .
                        "<br><img class='image_theme' src = '.." . utf8_encode($themes[$i][3]) . "'/>" .
                        "</a>";
                }
                else {
                    echo "<a class = 'themeButton' href='choixQuiz.php?id=".($i+1)."'>
                    <h1 class='titre_theme purple_title'>" . utf8_encode($themes[$i][1]) . "</h1>" .
                        "<h3 class='desc_theme'>" . utf8_encode($themes[$i][2]) . "</h3>" .
                        "<br><img class='image_theme' src = '.." . utf8_encode($themes[$i][3]) . "'/>" .
                        "</a>";
                }

                $i++;
            }
            ?>

        </div>

    </body>

</html>
