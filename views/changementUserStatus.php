<?php include "../includes/functions_db.php" ?>

<?php
    if(isset($_GET["id"]) && isset($_GET["status"])){
        $id = $_GET["id"];
        $status = $_GET["status"];
        update_user_status($id, $status);

        header("location: ./gererUsers.php");
    }

    else{
        header("location: ./gererUsers.php");
    }
 ?>
