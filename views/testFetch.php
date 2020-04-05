<html>
    <?php
        include "../includes/functions_db.php";
        include "../includes/functions.php";
     ?>

     <script type ="text/javascript">


        fetch('test.php').then(function(a){
            return a.json();
        }).then(function(result){
            // for(i of result){
            //     console.log(i);
            // }
            console.log(result[0][1]);
        });
    </script>


</html>
