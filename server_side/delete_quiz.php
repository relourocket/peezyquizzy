<?php
    include "../includes/functions_db.php";
    include "../includes/functions.php";
?>

<?php
    $idQuiz = $_GET["id"];

    $sql = connect_db();
    if($sql!=null){
        // effacer la relation quiz/question
        $stmt = $sql->prepare("DELETE FROM contain where quizz_id=?");
        $stmt->bind_param("i", $idQuiz);
        $stmt->execute();

        // effacer la relation quiz/score
        $stmt = $sql->prepare("DELETE FROM score where score_quizz=?");
        $stmt->bind_param("i", $idQuiz);
        $stmt->execute();

        // effacer le quiz
        if(!$stmt = $sql->prepare("DELETE FROM quizz WHERE quizz_id=?")){
            echo "échec de la préparation : ({$sql->errno}) {$sql->error}";
        }
        $stmt->bind_param("i", $idQuiz);
        $stmt->execute();
        $stmt->close();
    }

    else{
        return false;
    }
 ?>
