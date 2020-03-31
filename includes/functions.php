<?php

function check_confirm_password ($password, $confirm_password) {
    if (strcmp($password, $confirm_password) == 0) {
        return true;
    }
    else {
        return false;
    }
}

function insert_theme_options(){
    $themes = get_all_themes();
    foreach ($themes as $singleTheme) {
        $themeName = $singleTheme[1];
        echo "<option value='" .$themeName ."'>" .$themeName ."</option>";
    }
}

function upload_img(){
    // Déplace l'image uploadée dans le répertoire images
    // renvoie le path de l'image déplacée si le transfert est effectué
    // renvoie un chemin vers une image par défaut si ça échoue

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

function getNbQuestion($data){
    // détermine le nombre de question à partir des champs contenus dans le $_POST

    $regex = "#^enonceQ[0-9]+$#";
    $questionCount = 0;

    foreach(array_keys($data) as $key){
        if(preg_match($regex, $key)){
            $questionCount++;
        }
    }

    return $questionCount;
}

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
?>
