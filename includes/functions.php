<?php
/*
* vérifie si l'utilisateur est connecté. Renvoie true si c'est le cas, le redirige à l'accueil si non.
*/
function checkConnection(){
    if(isset($_SESSION) && !isset($_SESSION["login"])){
        header("Location: ./index.php");
    }
    else{
        return true;
    }
}

/*
* vérifie si l'utilisateur est un admin. Renvoie true si c'est le cas, le redirige à l'accueil si non.
*/
function checkAdmin(){
    if(isset($_SESSION) && isset($_SESSION["login"]) && isset($_SESSION["isAdmin"])){
        if($_SESSION["isAdmin"] != true){
            header("Location: ./index.php");
        }
    }
    else{
        return true;
    }
}

/*
* vérifie si les deux mots de passe rentrés sont les mêmes. Renvoie true si c'est le cas, false sinon
* @param $password le mot de passe rentré lors de l'inscription
* @param $confirm_password la confirmation du mot de passe
*/
function check_confirm_password ($password, $confirm_password) {
    if (strcmp($password, $confirm_password) == 0) {
        return true;
    }
    else {
        return false;
    }
}

/*
* récupère tous les thèmes existant en bdd et les ajoute au DOM
*/
function insert_theme_options(){
    $themes = get_all_themes();
    foreach ($themes as $singleTheme) {
        $themeName = $singleTheme[1];
        echo "<option value='" .$themeName ."'>" .$themeName ."</option>";
    }
}

/*
* Déplace l'image uploadée dans le répertoire images. Renvoie le path de l'image
* déplacée si le transfert est effectué. Renvoie un chemin vers une image par défaut
* si l'upload échoue.
* @return $imgName le path de l'image uploadée
*/
function upload_img(){
    if(isset($_FILES) && $_FILES["imgTheme"]["error"]==0){
        $extAllowed = array("jpeg", "jpg", "png");
        $path = "../images/";

        $imgName = $_FILES["imgTheme"]["name"];
        $tmp_name = $_FILES["imgTheme"]["tmp_name"]; // endroit où le fichier est stocké en tmp
        $imgExt = explode(".", $_FILES["imgTheme"]["name"]);
        $imgExt = end($imgExt);
        $imgSize = $_FILES["imgTheme"]["size"];

        //vérifie si un fichier du même nom existe déjà et modifie son nom si oui
        $imgName = checkFileName($path .$imgName);


        if(in_array($imgExt, $extAllowed) && $imgSize < (4 * 1024 * 1024)){
            move_uploaded_file($tmp_name, $path .$imgName);

            // on retourne le path sans les points devant
            $imgName = substr($imgName, 2);
            return $imgName;
        }
        else return "/images/default.jpg";
    }
}

/*
* check si le nom de fichier existe déjà et le modifie le cas échéant par récursivité.
* @param $file le path de l'image uploadée lors de la création du thème
* @return $fileName le path modifié de l'image uploadée si un path identique existe déjà
*/
function checkFileName($file){
    // check si le nom de fichier existe déjà et le modifie le cas échéant
    // par récursivité

    if(file_exists($file)){

        $splitted = explode(".", $file);

        // on rajoute les deux points qui ont été enlevés par explode
        $fileName = ".." .$splitted[count($splitted) - 2];
        $fileExt = $splitted[count($splitted) - 1];

        // regex pour déterminer si le fichier finit par un "(1)" ou autre nombre
        // entre parenthèses
        $regex = "#\([0-9]+\)$#";

        // si le fichier existe avec une terminaison (1)
        // récupère le numéro du fichier et l'incrémente
        if(preg_match($regex, $fileName)){
            $iStart;
            $iEnd = strlen($fileName) - 1;
            for($i = $iEnd; $fileName[$i] != "("; $i--){
                $iStart = $i;
            }

            $numero = (int) substr($fileName, $iStart, $iEnd - $iStart + 1);
            $numero++;

            // $iStart - 1 pour ne pas sélectionner la parenthèse ouvrante du path
            $newFileName = substr($fileName, 0, $iStart-1) ."({$numero})." .$fileExt;

            return checkFileName($newFileName);
        }

        else{
            $newFileName = $fileName ."(1)." .$fileExt;
            $newFileName;

            return checkFileName($newFileName);
        }
    }

    else{
        return $file;
    }

}

/*
* Détermine le nombre de question à partir des champs contenus dans le $_POST
* pour la sauvegarde du quiz en bdd.
* @param $data la variable $_POST reçu après la création d'un quiz
* @return $questionCount le nombre de questions utilisées dans le quiz
*/
function getNbQuestion($data){
    $regex = "#^Q[0-9]+$#";
    $questionCount = 0;

    foreach(array_keys($data) as $key){
        if(preg_match($regex, $key)){
            $questionCount++;
        }
    }

    return $questionCount;
}

/*
* Convertit la valeur de l'affichage en int pour la sauvegarder en bddd
* @param $affichage la valeur de l'affichage du quiz
* @return un scalaire permettant d'identifier le type d'affichage. 1 correspond à progressif, 0 à bloc.
*/
function convertAffichage($affichage){
    // renvoie 1 si question par question, 0 si bloc
    switch ($affichage) {
        case 'bloc':
            return 0;
            break;

        case 'progressif':
            return 1;
            break;
    }
}

/*
* Convertit la valeur de l'affichage en int pour la sauvegarder en bddd
* @param $affichage la valeur de l'affichage du quiz
* @return un scalaire permettant d'identifier le type d'affichage. 1 correspond à progressif, 0 à bloc.
*/
function convertDifficulte($difficulte){
    // convertit la valeur de difficulté en int pour insérer en bdd

    switch($difficulte){
        case "facile":
            return 1;
            break;

        case "moyen":
            return 2;
            break;

        case "difficile":
            return 3;
            break;
    }
}

/*
* Affiche les questions du quiz page après page
* @param $idQuiz l'id du quiz effectué
* @param $numQuestion le numéro de la question à la n-ième page
*/
function affichageQuizProgressif($idQuiz, $numQuestion){
    // affiche les questions et réponses d'un quiz page par page

    $questions = get_quizz_questions($idQuiz);
    // var_dump($questions);
    $idQuestion = $questions[$numQuestion][6];
    $answers = get_answers($idQuestion);

    $enonceQuestion = $questions[$numQuestion][8];
    $typeQuestion = $questions[$numQuestion][7];
    $numLabel = $numQuestion + 1;
    $numNextQuestion = $numQuestion + 1;

    $nbRep;
    switch($_POST["difficulte"]){
        case "facile":
            $nbRep = 3;
            break;

        case "moyen":
            $nbRep = 5;
            break;

        case "difficile":
            $nbRep = 8;
            break;
    }

    if($numQuestion+1 == sizeof($questions)){
        echo "<form method='post' action='./score.php' class='quizForm'>";
    }
    else{
        echo "<form method='post' action='./jouerQuiz.php?id={$idQuiz}' class='quizForm'>";
    }

    echo "<label class='jouerQuestion' for='question" .$numQuestion ."'> <span class='purple_title'>".  $numLabel . ". </span>" . $enonceQuestion . "</label><br>";

    // affichage de l'input
    if(strcmp($typeQuestion, "libre")==0){
        echo "<input type='text' id='question{$numQuestion}' name={$numQuestion} required>";
        echo "<br>";
    }
    elseif(strcmp($typeQuestion, "radio")==0){
        $indexUtilise = pickRandomAnswer($answers, $nbRep);

        // affichage des réponses
        $indexRadio = 0;
        foreach ($indexUtilise as $i) {
            echo "<div>
                      <input type='radio' name='{$numQuestion}' id='rep{$indexRadio}' value= '{$answers[$i][4]}' required>
                      <label for= 'rep{$indexRadio}'>". $answers[$i][4] ."</label>
                </div>";
            $indexRadio++;
        }
    }

    // passage en hidden pour les prochaines pages
    if($numQuestion==0){
        echo "<input type='hidden' name='idquizz' value='{$idQuiz}'>";
        echo "<input type='hidden' name='numQuestion' value='{$numNextQuestion}'>";
    }

    // passage en hidden des précédents résultats
    foreach($_POST as $key=>$value){
        if(strcmp($key, "numQuestion")==0){
            // passage du nouveau numéro de question en hidden
            echo "<input type='hidden' name='{$key}' value={$numNextQuestion}>";
        }
        else{
            echo "<input type='hidden' name='{$key}' value='{$value}'>";
        }
    }
}

/*
* Affiche toutes les questions d'un quiz sur une même page html
* @param $questions l'ensemble des questions du quiz
* @param $difficulte la difficulté du quiz
*/
function affichageQuizBloc($questions, $difficulte){
    // affiche toutes les questions et réponses d'un quiz sur la même page html

    $indexRadio = 0; //index pour répertorier les radios correctement
    $nbRep;
    switch($_POST["difficulte"]){
        case "facile":
            $nbRep = 3;
            break;

        case "moyen":
            $nbRep = 5;
            break;

        case "difficile":
            $nbRep = 8;
            break;
    }

    foreach ($questions as $q) {
        $idQuestion = $q[6];

        $answers = get_answers($idQuestion);
        $numeroQuestion = $q[11];
        $enonceQuestion = $q[8];

        echo "<form method='post' action='./score.php' class='quizForm'>";
        echo "<label class='question' for='question" .$numeroQuestion ."'> <span class='purple_title'>" .  $numeroQuestion . ". </span>" . $enonceQuestion . "</label><br>";

        if (strcmp($answers[0][1], "libre") == 0) {
            echo "<input type='text' id='question" .$numeroQuestion ."' name='". $numeroQuestion ."' required>";
            echo "<br>";
        }
        else if (strcmp($answers[0][1], "radio") == 0) {
            $indexUtilise = pickRandomAnswer($answers, $nbRep);

            // affichage des réponses
            foreach ($indexUtilise as $i) {
                echo "<div>
                          <input type='radio' name='" . $numeroQuestion . "' id='rep" .$indexRadio ."'value= '" . $answers[$i][4] . "' required>
                          <label for= 'rep" .$indexRadio ."'>". $answers[$i][4] ."</label>
                    </div>";
                $indexRadio++;
            }
        }
    }

    echo "<input type='hidden' name='idquizz' value='{$_GET["id"]} '>";
    echo "<input type='hidden' name='difficulte' value='{$_POST["difficulte"]}'>";
}

/*
* Effectue un tirage aléatoire de l'ordre des réponses pour une question donnée
* @param $answers les réponses de la question
* @param $nbRep le nombre de réponses pour la question donnée
* @return $indexUtilise un array d'index randomisé 
*/
function pickRandomAnswer($answers, $nbRep){
    // renvoie les indices des réponses utilisées dans un ordre aléatoire

    $indexUtilise = array();
    $nbUtilise = 1;

    // on trouve l'indice de la réponse juste
    for($iAnswer = 0; $iAnswer < sizeof($answers); $iAnswer++){
        if($answers[$iAnswer][5]==1){
            array_push($indexUtilise, $iAnswer);
        }
    }
    // sélection aléatoire de réponses fausses
    while($nbUtilise < $nbRep){
        $rng = rand(0, sizeof($answers)-1); //borne supérieure inclusive

        if(!in_array($rng, $indexUtilise)){
            array_push($indexUtilise, $rng);
            $nbUtilise++;
        }
    }

    // aléatorisation des réponses
    shuffle($indexUtilise);

    return $indexUtilise;
}
?>
