<?php session_start();


include "../includes/head.php";
include "../includes/functions_db.php";
include "../includes/functions.php";

checkConnection();
?>

<!doctype html>
<html>
    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">
            <h1 class="titre_admin">Tutoriel</h1>
            <h3 class="desc_admin">Comment jouer</h3>

            <div class="admin_boutons">
                <video controls width="720">
                    <source src="../videos/interface_joueur_final.mp4" type="video/mp4">
                </video>

                <?php
                    if(isset($_SESSION["login"]) && is_admin($_SESSION["login"])){
                        echo "<br> <br>";
                        echo "<h3 class='desc_admin'>Menu de gestion</h3>";
                        echo "<video controls width='720'>
                                <source src='../videos/admin_final.mp4' type='video/mp4'>
                              </video>";
                    }
                 ?>
            </div>

        </div>

    </body>

</html>
