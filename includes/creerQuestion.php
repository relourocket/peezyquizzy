<!doctype html>

<html>

    <head>
        <meta charset="utf-8"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
                            <option value="#">QCM </option>
                            <option value="#">Réponse ouverte</option>
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
