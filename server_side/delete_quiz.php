<?php
    include "../includes/functions_db.php";
    include "../includes/functions.php";
?>

<?php
    $idQuiz = $_GET["id"];

    $sql = connect_db();
    if($sql!=null){
        // effacer la relation
        $stmt = $sql->prepare("DELETE FROM contain where quizz_id=?");
        $stmt->bind_param("i", $idQuiz);
        $stmt->execute();

        $stmt->close();

        // effacer le quiz

        if(!$stmt = $sql->prepare("DELETE FROM quizz WHERE quizz_id=?")){
            die("échec de la préparation : ({$sql->errno}) {$sql->error}");
        }
        $stmt->bind_param("i", $idQuiz);
        $stmt->execute();
    }

    else{
        return false;
    }
 ?>
