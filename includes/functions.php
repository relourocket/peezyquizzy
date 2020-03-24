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
    if(isset($_FILE) && $_FILE["error"]==0){
        
    }
}



?>
