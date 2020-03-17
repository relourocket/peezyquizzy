<!doctype html>

<html>

    <head>
        <meta charset="utf-8"/>

        <link rel="stylesheet" href="../css/style.css">

    </head>

    <body>

        <div class="flex_column_div">
            <form>
                <div class="form-group row">
                    <label for="enonce" class="col-sm-3 col-form-label">Enoncé</label>
                    <div class="col-sm-9">
                      <input type="text" name="enonce" class="form-control" id="enonce">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="typeQuestion" class="col-sm-3 col-form-label">Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="typeQuestion">
                            <option selected>Type de Question </option>
                            <option value="qcm">QCM </option>
                            <option value="open">Réponse ouverte</option>
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="nbQuestion" class="col-sm-4 col-form-label">Nombre de questions</label>
                    <div class="col-sm-8">
                      <input type="text" name="nbQuestion" class="form-control" id="nbQuestion">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rep" class="col-sm-4 col-form-label">Réponse 1</label>
                    <div class="col-sm-8">
                      <input type="text" name="rep" class="form-control" id="rep">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rep" class="col-sm-4 col-form-label">Réponse 2</label>
                    <div class="col-sm-8">
                      <input type="text" name="rep" class="form-control" id="rep">
                    </div>
                </div>

            </form>
        </div>


    </body>

</html>
