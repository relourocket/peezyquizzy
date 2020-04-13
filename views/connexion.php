<!doctype html>
<?php session_start();?>

<html>

    <?php require_once "../includes/functions_db.php";
          require_once "../includes/functions.php";
          include "../includes/head.php" ?>

    <body>
        <?php include("../includes/navbar.php"); ?>

        <div class="flex_column_div">
            <h1 class="connexion_title">Connecte toi pour jouer</h1>

            <?php if (isset($_GET['error'])) {
                    if ($_GET['error'] == 1) {
                        echo '<div class="alert alert-danger" role="alert">Identifiant ou mot de passe incorrect, veuillez réessayer</div>';
                    }
                    else if ($_GET['error'] == 2) {
                        echo '<div class="alert alert-danger" role="alert">Cet identifiant n\'existe pas, veuillez en entrer un autre ou <a href="inscription.php">vous inscrire</a></div>';
                    }
                }
                if (isset($_GET['newuser'])) {
                    if ($_GET['newuser'] == 1) {
                        echo '<div class="alert alert-success" role="alert">Votre inscription a bien été prise en compte, veuillez vous connecter pour jouer</div>';
                    }
                }
                if (isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['mdpConfirm'])) {
                    if (pseudo_exists($_POST['login'])) {
                        header('location: ./inscription.php?error=1');
                    }
                    else if (!check_confirm_password($_POST['mdp'], $_POST['mdpConfirm'])) {
                        header('location: ./inscription.php?error=2');
                    }
                    else {
                        signin($_POST['login'], $_POST['mdp']);
                    }
                }
            ?>

            <form method="POST" action="./choixTheme.php" class="form_connexion">
                <div class="form-group row">
                    <label for="login">Login <span class="purple_title col">*</span> </label>
                    <input type="text" name="login" id="login" class="form-control" required>
                </div>

                <div class="form-group row">
                    <label for="mdp">Mot de passe <span class="purple_title col">*</span> </label>
                    <input type="password" name="mdp" id="mdp" class="form-control" required>
                </div>

                <button type="submit" class="btn_form btn green">Je me connecte</button>
            </form>


        </div>

    </body>

</html>
