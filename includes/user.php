<html>
    <body>
        <div class="user">
            <div>
                <?php echo $person[1];?>
            </div>

            <div>
                Admin :
                <?php
                    if($person[3]==1) echo "Oui";
                    else echo "Non";
                ?>
            </div>

            <a class="nav nav-link" href="./changementUserStatus.php<?php echo "?id=" .$person[0] ."&status=" .$person[3]?>">Changer</a>
        </div>

    </body>

</html>
