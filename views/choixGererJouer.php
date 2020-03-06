<!doctype html>

<html>

    <?php include "../includes/head.php"?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">

            <!-- Ici je crée un form pour faire de la navigation avec les boutons
        C'est dégueux mais comme je connais pas javascript j'ai préféré faire ça :)) -->
        
            <form action="index.php">
                <button class="bigButton" >
                    Gérer
                </button>
            </form>

            <form action="index.php">
                <button class="bigButton">
                    Jouer
                </button>
            </form>

        </div>

    </body>

</html>
