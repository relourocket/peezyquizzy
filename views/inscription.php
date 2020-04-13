<!doctype html>
<?php session_start();?>

<html>

    <?php include "../includes/head.php"?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">
            <h1 class="connexion_title">Bienvenue à toi. Inscris-toi pour jouer !</h1>

            <?php if (isset($_GET['error'])) {
                    if ($_GET['error'] == 1) {
                        echo '<div class="alert alert-danger" role="alert">Cet identifiant existe déjà, veuillez en entrer un autre ou <a href="connexion.php">vous connecter</a></div>';
                    }
                    else if ($_GET['error'] == 2) {
                        echo '<div class="alert alert-danger" role="alert">Les deux mots de passe ne correspondent pas, veuillez réessayer</div>';
                    }
                }
            ?>

            <form method="POST" action="connexion.php?newuser=1" class="form_connexion">
                <div class="form-group row">
                    <label for="login">Login <span class="purple_title col">*</span> </label>
                    <input type="text" name="login" id="login" class="form-control" required>
                </div>

                <div class="form-group row">
                    <label for="mdp">Mot de passe <span class="purple_title col">*</span> </label>
                    <input type="password" name="mdp" id="mdp" class="form-control" required>
                </div>

                <div class="form-group row">
                    <label for="mdpConfirm">Confirmation du mot de passe <span class="purple_title col">*</span> </label>
                    <input type="password" name="mdpConfirm" id="mdpConfirm" class="form-control" required>
                </div>

                <button type="submit" class="btn btn_form green">Confirmer </button>
            </form>

        </div>

    </body>

</html>
