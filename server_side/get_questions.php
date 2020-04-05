<?php
    include "../includes/functions_db.php";
    include "../includes/functions.php";
 ?>

 <?php
    $questions = get_all_questions();
    echo json_encode($questions);
 ?>
