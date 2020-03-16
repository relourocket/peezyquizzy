<!doctype html>

<html>

    <?php include "head.php";
          require_once "functions_db.php"
    ?>

    <body>

    <?php
        if(isset($_GET['message']) && strcmp($_GET['message'],"ok") == 0) {
            echo "<div class=\"alert alert-success\" role=\"alert\">
                      La question a été créée avec succès
                 </div>";
        }

        if (isset($_POST['enonce']) && isset($_POST['type_question']) &&
                  isset($_POST['rep']) && isset($_POST['rep1']) &&
                  isset($_POST['rep2'])  && isset($_POST['rep3']) &&
                  isset($_POST['rep4'])  && isset($_POST['rep5']) &&
                  isset($_POST['rep6'])  && isset($_POST['rep7']) &&
                  isset($_POST['rep8'])) {

            save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                          $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8']);

        }

    ?>

        <div class="flex_column_div">
            <form class="creer_question" method="POST" action="creerQuestion.php?message=ok">
                <div class="form-group row">
                    <label for="enonce" class="col-sm-3 col-form-label">Enoncé</label>
                    <div class="col-sm-9">
                      <input type="text" name="enonce" class="form-control" id="enonce">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="type_question" class="col-sm-3 col-form-label">Type</label>
                    <div class="col-sm-9">
                        <select name="type_question" class="form-control" id="typeQuestion" onchange="select()">
                            <option selected value="typeQ">Type de Question </option>
                            <option value="radio">QCM </option>
                            <option value="libre">Réponse ouverte</option>
                        </select>
                    </div>
                </div>

                <div id="libre">
                    <div class="form-group row">
                        <label for="enonce" class="col-sm-3 col-form-label">Réponse</label>
                        <div class="col-sm-9">
                            <input type="text" name="rep" class="form-control" id="enonce">
                        </div>
                    </div>
                </div>

                <div id="qcm">
                    <div class="form-group row">
                        <label for="rep1" class="col-sm-4 col-form-label">Réponse 1</label>
                        <div class="col-sm-8">
                          <input type="text" name="rep1" class="form-control" id="rep">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep2" class="col-sm-4 col-form-label">Réponse 2</label>
                        <div class="col-sm-8">
                          <input type="text" name="rep2" class="form-control" id="rep">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep3" class="col-sm-4 col-form-label">Réponse 3</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep3" class="form-control" id="rep">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep4" class="col-sm-4 col-form-label">Réponse 4</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep4" class="form-control" id="rep">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep5" class="col-sm-4 col-form-label">Réponse 5</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep5" class="form-control" id="rep">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep6" class="col-sm-4 col-form-label">Réponse 6</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep6" class="form-control" id="rep">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep7" class="col-sm-4 col-form-label">Réponse 7</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep7" class="form-control" id="rep">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep8" class="col-sm-4 col-form-label">Réponse 8</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep8" class="form-control" id="rep">
                        </div>
                    </div>
                </div>

                <button type="submit">Créer</button>

            </form>
        </div>

    </body>

    <script src="../js/creer_question.js"></script>

</html>
