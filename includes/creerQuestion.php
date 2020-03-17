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

            if (isset($_POST['rep1T'])) {
                save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                    $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 1);
            }
            elseif (isset($_POST['rep2T'])) {
                save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                    $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 2);
            }
            elseif (isset($_POST['rep3T'])) {
                save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                    $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 3);
            }
            elseif (isset($_POST['rep4T'])) {
                save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                    $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 4);
            }
            elseif ($_POST['rep5T']) {
                save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                    $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 5);
            }
            elseif (isset($_POST['rep6T'])) {
                save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                    $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 6);
            }
            elseif (isset($_POST['rep7T'])) {
                save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                    $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 7);
            }
            elseif (isset($_POST['rep8T'])) {
                save_question($_POST['enonce'], $_POST['type_question'], $_POST['rep'], $_POST['rep1'], $_POST['rep2'], $_POST['rep3'], $_POST['rep4'],
                    $_POST['rep5'], $_POST['rep6'], $_POST['rep7'], $_POST['rep8'], 8);
            }

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
                        <div class="col-sm-8 goodAnswer">
                            <input type="radio" name="rep1T">
                            <label for="rep1T">Réponse juste</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep2" class="col-sm-4 col-form-label">Réponse 2</label>
                        <div class="col-sm-8">
                          <input type="text" name="rep2" class="form-control" id="rep">
                        </div>
                        <div class="col-sm-8 goodAnswer">
                            <input type="radio" name="rep2T">
                            <label for="rep2T">Réponse juste</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep3" class="col-sm-4 col-form-label">Réponse 3</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep3" class="form-control" id="rep">
                        </div>
                        <div class="col-sm-8 goodAnswer">
                            <input type="radio" name="rep3T">
                            <label for="rep3T">Réponse juste</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep4" class="col-sm-4 col-form-label">Réponse 4</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep4" class="form-control" id="rep">
                        </div>
                        <div class="col-sm-8 goodAnswer">
                            <input type="radio" name="rep4T">
                            <label for="rep4T">Réponse juste</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep5" class="col-sm-4 col-form-label">Réponse 5</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep5" class="form-control" id="rep">
                        </div>
                        <div class="col-sm-8 goodAnswer">
                            <input type="radio" name="rep5T">
                            <label for="rep5T">Réponse juste</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep6" class="col-sm-4 col-form-label">Réponse 6</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep6" class="form-control" id="rep">
                        </div>
                        <div class="col-sm-8 goodAnswer">
                            <input type="radio" name="rep6T">
                            <label for="rep6T">Réponse juste</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep7" class="col-sm-4 col-form-label">Réponse 7</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep7" class="form-control" id="rep">
                        </div>
                        <div class="col-sm-8 goodAnswer">
                            <input type="radio" name="rep7T">
                            <label for="rep7T">Réponse juste</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rep8" class="col-sm-4 col-form-label">Réponse 8</label>
                        <div class="col-sm-8">
                            <input type="text" name="rep8" class="form-control" id="rep">
                        </div>
                        <div class="col-sm-8 goodAnswer">
                            <input type="radio" name="rep8T">
                            <label for="rep8T">Réponse juste</label>
                        </div>
                    </div>
                </div>

                <button type="submit">Créer</button>

            </form>
        </div>

    </body>

    <script src="../js/creer_question.js"></script>

</html>
