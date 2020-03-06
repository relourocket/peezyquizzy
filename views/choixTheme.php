<!doctype html>

<html>

    <?php include "../includes/head.php";
          require_once "../includes/functions_db.php";
    ?>

    <body>
        <?php
        require_once "../includes/functions_db.php";
        if (isset($_POST['login']) && isset($_POST['mdp'])) {
            if (!pseudo_exists($_POST['login'])) {
                echo "Pseudo existe pas";
                header('location: ./connexion.php?error=2');
            }
            else if(!check_logs($_POST['login'], $_POST['mdp'])) {
                header('location: ./connexion.php?error=1');
            }
        }

        ?>
        <?php include("../includes/navbar.php");
              $themes = get_all_themes();
        ?>

        <div class="choixConteneur">

            <?php
            $i = 0;
            foreach ($themes as $key => $value) {
                echo "<a class = 'themeButton' href='choixQuiz.php?id=".($i+1)."'>" . utf8_encode($themes[$i][1]) .
                    "<br>" . utf8_encode($themes[$i][2]) .
                    "<br><img src = '.." . utf8_encode($themes[$i][3]) . "'/>" .
                    "</a>";
                $i++;
            }
            ?>

        </div>

    </body>

</html>
