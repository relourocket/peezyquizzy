<html>
    <body>
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
                echo $_SESSION["login"];
            ?>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="./profil.php">Profil</a>
            <a class="dropdown-item" href="./index.php?logout=true">Se déconnecter</a>
        </div>
    </body>
</html>
