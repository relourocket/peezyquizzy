<!doctype html>

<html>


    <?php
          require_once "functions_db.php"
    ?>
    <?php include "../includes/head.php"?>

    <body>

    <?php

        // if(isset($_GET['message']) && strcmp($_GET['message'],"ok") == 0) {
        //     echo "<div class=\"alert alert-success\" role=\"alert\">
        //               La question a été créée avec succès
        //          </div>";
        // }
        //
        // if (isset($_POST['enonce']) && isset($_POST['type_question']) &&
        //           isset($_POST['rep']) && isset($_POST['rep1']) &&
        //           isset($_POST['rep2'])  && isset($_POST['rep3']) &&
        //           isset($_POST['rep4'])  && isset($_POST['rep5']) &&
        //           isset($_POST['rep6'])  && isset($_POST['rep7']) &&
        //           isset($_POST['rep8'])) {
        //
        //     if (isset($_POST['rep1T'])) {
        //         save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
        //             $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 1);
        //     }
        //     elseif (isset($_POST['rep2T'])) {
        //         save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
        //             $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 2);
        //     }
        //     elseif (isset($_POST['rep3T'])) {
        //         save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
        //             $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 3);
        //     }
        //     elseif (isset($_POST['rep4T'])) {
        //         save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
        //             $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 4);
        //     }
        //     elseif ($_POST['rep5T']) {
        //         save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
        //             $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 5);
        //     }
        //     elseif (isset($_POST['rep6T'])) {
        //         save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
        //             $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 6);
        //     }
        //     elseif (isset($_POST['rep7T'])) {
        //         save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
        //             $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 7);
        //     }
        //     elseif (isset($_POST['rep8T'])) {
        //         save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
        //             $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 8);
        //     }
        //
        // }


    ?>

        <!-- Enoncé -->

        <div class="form-group row">
            <label for="enonce" class="col-sm-3 col-form-label">Enoncé</label>
            <input type="text" name="enonce[]" class="form-control col-sm-9" id="enonce" >

        </div>

        <!-- Sélection type de question -->
        <div class="form-group row">
            <label for="type_question" class="col-sm-3 col-form-label">Type</label>
            <select name="type_question" class="form-control col-sm-9" id="typeQuestion" onchange="select()">
                <option selected value="type_Q">Type de Question </option>
                <option value="qcm">QCM </option>
                <option value="libre">Réponse ouverte</option>
            </select>

        </div>

        <!-- Question libre -->
        <div id="libre">
            <div class="form-group row">
                <label for="repLibre" class="col-sm-3 col-form-label">Réponse</label>
                <input type="text" name="rep" class="form-control col-sm-9" id="repLibre" >
            </div>
        </div>

        <!-- QCM -->
        <div id="qcm">
            <div class="form-group row">
                <label for="rep1" class="col-sm-4 col-form-label">Réponse 1</label>
                <div class="col-sm-8">
                  <input type="text" name="rep1" class="form-control" id="rep" >
                </div>
                <div class="col-sm-8 goodAnswer">
                    <input type="radio" id="rep1T" name="juste" value=1>
                    <label for="rep1T">Réponse juste</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="rep2" class="col-sm-4 col-form-label">Réponse 2</label>
                <div class="col-sm-8">
                  <input type="text" name="rep2" class="form-control" id="rep" >
                </div>
                <div class="col-sm-8 goodAnswer">
                    <input type="radio" id="rep2T" name="juste" value=2>
                    <label for="rep2T">Réponse juste</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="rep3" class="col-sm-4 col-form-label">Réponse 3</label>
                <div class="col-sm-8">
                    <input type="text" name="rep3" class="form-control" id="rep" >
                </div>
                <div class="col-sm-8 goodAnswer">
                    <input type="radio" id="rep3T" name="juste" value=3>
                    <label for="rep3T">Réponse juste</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="rep4" class="col-sm-4 col-form-label">Réponse 4</label>
                <div class="col-sm-8">
                    <input type="text" name="rep4" class="form-control" id="rep" >
                </div>
                <div class="col-sm-8 goodAnswer">
                    <input type="radio" id="rep4T" name="juste" value=4>
                    <label for="rep4T">Réponse juste</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="rep5" class="col-sm-4 col-form-label">Réponse 5</label>
                <div class="col-sm-8">
                    <input type="text" name="rep5" class="form-control" id="rep" >
                </div>
                <div class="col-sm-8 goodAnswer">
                    <input type="radio" id="rep5T" name="juste" value=5>
                    <label for="rep5T">Réponse juste</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="rep6" class="col-sm-4 col-form-label">Réponse 6</label>
                <div class="col-sm-8">
                    <input type="text" name="rep6" class="form-control" id="rep" >
                </div>
                <div class="col-sm-8 goodAnswer">
                    <input type="radio" id="rep6T" name="juste" value=6>
                    <label for="rep6T">Réponse juste</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="rep7" class="col-sm-4 col-form-label">Réponse 7</label>
                <div class="col-sm-8">
                    <input type="text" name="rep7" class="form-control" id="rep" >
                </div>
                <div class="col-sm-8 goodAnswer">
                    <input type="radio" id="rep7T" name="juste" value=7>
                    <label for="rep7T">Réponse juste</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="rep8" class="col-sm-4 col-form-label">Réponse 8</label>
                <div class="col-sm-8">
                    <input type="text" name="rep8" class="form-control" id="rep" >
                </div>
                <div class="col-sm-8 goodAnswer">
                    <input type="radio" id="rep8T" name="juste" value=8>
                    <label for="rep8T">Réponse juste</label>
                </div>
            </div>
        </div>


    </body>

    <script src="../js/creer_question.js"></script>

</html>
