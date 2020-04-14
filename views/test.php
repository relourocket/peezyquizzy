<?php
    include "../includes/functions_db.php";
    include "../includes/functions.php";

    $a = get_all_scores_by_user("aparize");

    var_dump($a);

 ?>
