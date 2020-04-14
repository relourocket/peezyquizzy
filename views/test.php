<?php
    include "../includes/functions_db.php";
    include "../includes/functions.php";

    $a = get_quizz_questions(3);
$b = get_answers(12);
    var_dump($a);
    echo "<br><br>";

    var_dump($b);
echo "<br><br>";
    $q = get_quizz_questions(4);
    var_dump($q);

 ?>
