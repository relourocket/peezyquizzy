<!doctype html>

<html>

    <body>
        <nav class="navbar navbar-expand navbar-light bg-light">

            <div class="flex_nav">
                <div id="navigation">
                    <a class="navbar-brand" href="choixTheme.php">QueezyPeezy</a>

                    <?php
                        if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]==true){
                            include "../includes/navbarGererJouer.php";
                        }
                    ?>

                </div>

                <div class="dropdown navbar-brand">
                    <?php
                        if(isset($_SESSION["login"])){
                            include("../includes/navbarDropdown.php") ;
                        }
                    ?>
                </div>
            </div>

        </nav>

    </body>

</html>
