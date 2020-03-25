<html>
    <body>
        <div class="user">
            <div class="identite">
                <div class="pseudo">
                    <?php echo $person[1];?>
                </div>

                <div>
                    Admin :
                    <?php
                        if($person[3]==1) echo "Oui";
                        else echo "Non";
                    ?>
                </div>
            </div>

            <?php if ($person[3] == 1) { ?>
            <a class="nav nav-link btn_form changer purple" href="./changementUserStatus.php<?php echo "?id=" .$person[0] ."&status=" .$person[3]?>">Changer</a>
            <?php } else { ?>
                <a class="nav nav-link btn_form changer green" href="./changementUserStatus.php<?php echo "?id=" .$person[0] ."&status=" .$person[3]?>">Changer</a>
            <?php } ?>
        </div>

    </body>

</html>
