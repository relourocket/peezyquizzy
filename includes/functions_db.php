<?php

/**
 * Etabli la connection avec la base de données
 * @return mysqli l'objet de connection
 */
function connect_db () {
    $mysqli = new mysqli("localhost", "root", "", "myquizz");
    $mysqli->set_charset("utf8");
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    else {
        return $mysqli;
    }
}

/**
 * Vérifie que le pseudo et le mot de passe entrés correspondent à un compte existant
 * @param $login le pseudo entré
 * @param $password le mot de passe entré
 * @return true si les logs sont corrects, false sinon
 */
function check_logs($login, $password) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT * FROM users WHERE user_login = ? AND user_password = ?");
        $stmt->bind_param("ss", $id, $pass);
        $id = $login;
        $pass = $password;
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $logs = $result->fetch_all(); // fetch data
        $stmt->close();

        if (!empty($logs)) {
            return true;
        } else {
            return false;
        }

    } else {
        die("No database found...");
    }
}

/**
 * Vérifie que le pseudo entré existe dans la base de données
 * @param $login Le pseudo entré
 * @return true si le pseudo existe, false sinon
 */
function pseudo_exists ($login) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT * FROM users WHERE user_login = ?");
        $stmt->bind_param("s", $id);
        $id = $login;
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $logs = $result->fetch_all(); // fetch data
        $stmt->close();

        if (!empty($logs)) {
            return true;
        } else {
            return false;
        }

    } else {
        die("No database found...");
    }
}

/**
 * Insère dans la BDD les informations du nouveau compte utilisateur
 * @param $login Le pseudo du nouvel utilisateur
 * @param $password Le mot de passe du nouvel utilisateur
 */
function signin ($login, $password) {
    $sql = connect_db();
    if ($sql != null) {
        $stmt = $sql->prepare("INSERT INTO users VALUES (0, ?, ?, 0)");
        $stmt->bind_param("ss", $id, $pswd);
        $id = $login;
        $pswd = $password;
        $stmt->execute();
        $stmt->close();
    } else {
        die("No database found...");
    }
}

/**
 * Vérifie si un utilisateur est administrateur
 * @param $login Le pseudo de l'utilisateur
 * @return true si l'utilisateur est un administrateur, false sinon
 */
function is_admin($login){
    // renvoie true si l'utilisateur est un admin, false sinon
    // la recherche s'effectue sur la base du login de l'utilisateur
    $sql = connect_db();
    if($sql != null){
        $stmt = $sql->prepare("SELECT * FROM users WHERE user_login=? AND user_isadmin=1");
        $stmt->bind_param("s", $id);
        $id = $login;
        $stmt->execute();
        $result = $stmt->get_result();
        $logs = $result->fetch_all();
        $stmt->close();

        if(!empty($logs)){
            return true;
        }
        else{
            return false;
        }
    }

    else {
        die("No database found...");
    }

}

/**
 * Récupère tous les thèmes existants dans la base de données
 * @return les thèmes existants
 */
function get_all_themes () {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT * FROM theme");
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $themes = $result->fetch_all(); // fetch data
        $stmt->close();

        return $themes;

    } else {
        die("No database found...");
    }
}

/**
 * Récupère les noms de tous les thèmes de la BDD
 * @return Les noms de tous les thèmes
 */
function get_all_themes_names () {
    // renvoie tous les noms de tous les themes

    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT theme_name FROM theme");
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $themes = $result->fetch_all(); // fetch data
        $stmt->close();

        $names = array();
        foreach($themes as $singleTheme){
            array_push($names, $singleTheme[0]);
        }
        return $names;

    } else {
        die("No database found...");
    }
}

/**
 * Récupère les informations du quiz ayant l'id en paramètre
 * @param $idQuiz l'id du quiz
 * @return Les informations du quiz
 */
function get_quiz($idQuiz){
    $sql = connect_db();
    if($sql != null){
        $stmt = $sql->prepare("SELECT * FROM quizz WHERE quizz_id=?");
        $stmt->bind_param("s", $idQuiz);

        $stmt->execute();
        $result = $stmt->get_result();
        $quiz = $result->fetch_all();
        $stmt->close();

        return $quiz[0];
    }

    else {
        die("No database found...");
    }
}

/**
 * Récupère tous les quiz sur le thème donné
 * @param $themeid L'id du thème donné
 * @return Les quiz du thème donné
 */
function get_all_quizz_per_theme ($themeid) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT * FROM quizz WHERE quizz_theme = ?");
        $stmt->bind_param("s", $theme);
        $theme = $themeid;
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $themes = $result->fetch_all(); // fetch data
        $stmt->close();

        return $themes;

    } else {
        die("No database found...");
    }
}

/**
 * Récupère tous les quiz existants dans la BDD
 * @return Tous les quiz
 */
function get_all_quizz(){
    $sql = connect_db();
    if($sql!=null){
        $stmt = $sql->prepare("SELECT * FROM quizz");
        $stmt->execute();
        $res = $stmt->get_result();
        $quiz = $res->fetch_all();

        return $quiz;
    }

    else {
        die("No database found...");
    }
}

/**
 * Récupère les informations d'un thème en fonction de son id
 * @param $id L'id du thème
 * @return Les informations du thème
 */
function get_theme_by_id($id){
    // renvoie un theme donné en fonction de son id

    $sql = connect_db();
    if($sql!=null){
        $stmt = $sql->prepare("SELECT * FROM theme where theme_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $theme = $res->fetch_all();

        return $theme[0];
    }

    else {
        die("No database found...");
    }
}

/**
 * Récupère toutes les questions présentes dans la BDD
 * @return questions Toutes les questions de la BDD
 */
function get_all_questions(){
    $sql = connect_db();
    if($sql!=null){
        $stmt = $sql->prepare("SELECT * FROM question");
        $stmt->execute();
        $result = $stmt->get_result();
        $questions = $result->fetch_all();

        return $questions;
    }

    else die("pas de connexion possible");
}

/**
 * Récupère toutes les questions d'un quiz donné
 * @param $quizzid L'id du quiz donné
 * @return questions Les questions du quiz donné
 */
function get_quizz_questions ($quizzid) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT * from quizz, question, contain where quizz.quizz_id = ? and quizz.quizz_id = contain.quizz_id and question.question_id = contain.question_id");
        $stmt->bind_param("s", $quizz);
        $quizz = $quizzid;
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $questions = $result->fetch_all(); // fetch data
        $stmt->close();

        return $questions;

    } else {
        die("No database found...");
    }
}

/**
 * Récupère une question d'un quiz
 * @param $idQuiz L'id du quiz
 * @param $idQuestion L'id de la question
 * @return question La question récupérée
 */
function get_quiz_question_by_id($idQuiz, $idQuestion){
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT question.question_id, question.question_type, question.question_enonce, contain.question_numero
            from quizz, question, contain
            where quizz.quizz_id = ? and question.question_id=? and quizz.quizz_id = contain.quizz_id and question.question_id = contain.question_id ");
        $stmt->bind_param("ii", $idQuiz, $idQuestion);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $question = $result->fetch_all(); // fetch data
        $stmt->close();

        return $question;

    } else {
        die("No database found...");
    }
}

/**
 * Récupère les réponses d'une question
 * @param $questionid La question dont on veut les réponses
 * @return $answers Les réponses à la question
 */
function get_answers ($questionid) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("select * from question, answer, belongs where question.question_id = ? and question.question_id = belongs.question_id and answer.answer_id = belongs.answer_id");
        $stmt->bind_param("s", $question);
        $question = $questionid;
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $answers = $result->fetch_all(); // fetch data
        $stmt->close();

        return $answers;

    } else {
        die("No database found...");
    }
}

/**
 * Récupère le score et le score total possible
 * @param $answers Les réponses au quiz
 * @return Le score et le score total
 */
function get_score ($answers) {
    // renvoie dans un tableau le score du joueur et le score total possible

    $score = 0;
    $i = 0;

    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT contain.question_numero, answer.answer_enonce from question, answer, belongs, contain, quizz
        where answer.answer_id = belongs.answer_id and question.question_id = belongs.question_id
        and question.question_id = contain.question_id and quizz.quizz_id = contain.quizz_id and quizz.quizz_id = ? and answer.answer_istrue = 1");
        $stmt->bind_param("s", $answers['idquizz']);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $answers_true = $result->fetch_all(); // fetch data
        $stmt->close();

        // on trie les clés par ordre croissant pour comparer les questions/reponses
        ksort($answers);

        //unset pour éviter de gérer ces paramètres dans la recherche de bonne réponse
        // la recherche s'effectue grâce à une correcpondance entre les rep données et les rep de la bdd
        unset($answers["idquizz"]);
        unset($answers["difficulte"]);
        unset($answers["numQuestion"]);

        foreach ($answers as $answer) {
            if ($i < count($answers)) {
                //strcmp() renvoie 0 si les string sont égales
                if (strcmp(strtolower($answer), strtolower($answers_true[$i][1])) == 0) {
                    $score++;
                }
            }
            $i++;
        }

        return array($score, sizeof($answers_true));
    }
    else {
        die("No database found...");
    }
}

/**
 * Récupère l'id d'un utilisateur grâce à son pseudo
 * @param $pseudo Le pseudo du joueur
 * @return L'id de l'utilisateur
 */
function get_user_id ($pseudo) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT user_id FROM users WHERE user_login = ?");
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $id = $result->fetch_all(); // fetch data
        $stmt->close();

        return $id;

    } else {
        die("No database found...");
    }
}

/**
 * Insère un nouveau score dans la BDD
 * @param $points Le score réalisé (nombre de points)
 * @param $quizzid L'id du quiz sur lequel à été effectué le score
 * @param $pseudo Le pseudo du joueur qui a effectué le score
 * @param $difficulte La difficulté du quiz
 */
function save_score ($points, $quizzid, $pseudo, $difficulte) {
    $sql = connect_db();
    if ($sql != null) {
        $stmt = $sql->prepare("INSERT INTO score VALUES (0, ?, ?, ?, ?)");
        $stmt->bind_param("iiis", $userid, intval($quizzid), $points, $difficulte);
        $userid = get_user_id($pseudo)[0][0];
        $stmt->execute();
        $stmt->close();
    } else {
        die("No database found...");
    }
}

/**
 * Récupère le meilleur score d'un utilisateur sur un quiz
 * @param $user L'id de l'utilisateur
 * @param $idQuiz L'id du quiz
 * @return Le meilleur score sur le quiz
 */
function get_best_score ($user, $idQuiz) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT max(score_points) FROM score WHERE score_user = ? and score_quizz=?");
        $stmt->bind_param("ii", $userid, $idQuiz);
        $userid = get_user_id($user)[0][0];
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $best_score = $result->fetch_all(); // fetch data
        $stmt->close();

        return $best_score[0][0];

    } else {
        die("No database found...");
    }
}

/**
 * Récupère tous les scores d'un utilisateur
 * @param $user Le pseudo de l'utilisateur
 * @return Tous les scores de l'utilisateur
 */
function get_all_scores_by_user ($user) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT quizz.quizz_id, quizz.quizz_titre, score.score_points, quizz.quizz_nbquestions, score.score_difficulte from score, quizz where quizz.quizz_id = score.score_quizz and score_user = ?");
        $stmt->bind_param("i", $userid);
        $userid = get_user_id($user)[0][0];
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $scores = $result->fetch_all(); // fetch data
        $stmt->close();

        return $scores;

    } else {
        die("No database found...");
    }
}

/**
 * Récupère tous les utilisateurs de la base de données
 * @return Tous les utilisateurs
 */
function get_all_users(){
    $sql = connect_db();
    if($sql!=null){
        $stmt = $sql->prepare("select * from users");
        $stmt->execute();
        $res = $stmt->get_result();
        $users = $res->fetch_all();
        $stmt->close();

        return $users;
    }
    else{
        die("No database found");
    }
}

/**
 * Met à jour le statut d'un utilisateur (administrateur ou non)
 * @param $id L'id de l'uitlisateur dont le statut doit être mis à jour
 * @param $status Le nouveau statut
 */
function update_user_status($id, $status){
    //affectation nouvelle valeur du statut
    if($status==1) $newStatus = 0;
    elseif($status==0) $newStatus = 1;
    else return false;

    //envoie requête
    $sql = connect_db();
    if($sql!=null){
        $stmt = $sql->prepare("update users set user_isadmin=? where user_id=?");
        $stmt->bind_param("ii", $newStatus, $id);
        $stmt->execute();
        $stmt->close();
    }

    else{
        die("No database found");
    }
}

/**
 * Sauvegarde toutes les questions et les lie au questionnaire auquel elles appartiennent
 * @param $data Les questions à sauvegarder
 */
function saveAllQuestions($data){
    // sauvegarde toutes les questions et les lie au
    // questionnaire auquel elles appartiennent

    // on obtient toutes les questions du quiz
    // l'affectation de la regex dépend de si on enregistre une question seule
    // ou si c'est une question d'un quiz
    $regexQuestion;
    $questions = array();

    if(isset($_POST["questionSeule"])){
        $regexQuestion = "#^typeQuestionQ[0-9]+$#";
        foreach($data as $key => $val){
            if(preg_match($regexQuestion, $key)){
                array_push($questions, substr($key,12));
            }
        }
    }
    else{
        $regexQuestion = "#^Q[0-9]+$#";
        foreach($data as $key => $val){
            if(preg_match($regexQuestion, $key)){
                array_push($questions, $key);
            }
        }
    }

    $numeroQuestion = 1; // indice pour la sauvegarde dans la table contain

    foreach($questions as $q){
        if(isset($_POST["questionSeule"])){
            $enonce = $data["enonce{$q}"];
            $type = $data["typeQuestion{$q}"];

            switch($type){
                case "libre":
                    $rep = $data["repLibre{$q}"];
                    saveQuestionLibre($enonce, $type, $rep);
                    break;

                case "qcm":
                    saveQcm($enonce, $data["rep1{$q}"], $data["rep2{$q}"],
                            $data["rep3{$q}"], $data["rep4{$q}"], $data["rep5{$q}"],
                            $data["rep6{$q}"], $data["rep7{$q}"], $data["rep8{$q}"],
                            $data["juste{$q}"]);
                    break;
            }
        }

        elseif(strcmp($data[$q], "nouveau")==0){
            $enonce = $data["enonce{$q}"];
            $type = $data["typeQuestion{$q}"];

            switch($type){
                case "libre":
                    $rep = $data["repLibre{$q}"];
                    saveQuestionLibre($enonce, $type, $rep);
                    break;

                case "qcm":
                    saveQcm($enonce, $data["rep1{$q}"], $data["rep2{$q}"],
                            $data["rep3{$q}"], $data["rep4{$q}"], $data["rep5{$q}"],
                            $data["rep6{$q}"], $data["rep7{$q}"], $data["rep8{$q}"],
                            $data["juste{$q}"]);
                    break;
            }

            if(!isset($_POST["questionSeule"])){
                linkNewQuestionToQuiz($numeroQuestion);
            }
        }

        else{
            if(!isset($_POST["questionSeule"])){
                linkExistingQuestionToQuiz($data[$q], $numeroQuestion);
            }
        }
        $numeroQuestion++;
    }

}

/**
 * Sauvegarde une question à choix multiple et les réponses qui lui sont associées
 * @param $enonce L'énoncé de la question
 * @param $qcm1 La première réponse
 * @param $qcm2 La deuxième réponse
 * @param $qcm3 La troisième réponse
 * @param $qcm4 La quatrième réponse
 * @param $qcm5 La cinquième réponse
 * @param $qcm6 La sixième réponse
 * @param $qcm7 La septième réponse
 * @param $qcm8 La huitième réponse
 * @param $juste La réponse juste
 */
function saveQcm ($enonce, $qcm1, $qcm2, $qcm3, $qcm4, $qcm5, $qcm6, $qcm7, $qcm8, $juste) {
    // Sauvegarde une question de type QCM ainsi que toutes ses réponses
    // associées

    $sql = connect_db();
    if ($sql != null) {

        $type = "radio";

        // Insertion question
        $stmt = $sql->prepare("INSERT INTO question VALUES (0, ?, ?)");
        $stmt->bind_param("ss", $type, $enonce);
        $stmt->execute();

        // Insertion réponse 1
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, ?)");
        $good = $juste==1?1:0;
        $stmt->bind_param("si", $qcm1, $good);
        $stmt->execute();

        // Insertion réponse 2
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, ?)");
        $good = $juste==2?1:0;
        $stmt->bind_param("si", $qcm2, $good);
        $stmt->execute();

        // Insertion réponse 3
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, ?)");
        $good = $juste==3?1:0;
        $stmt->bind_param("si", $qcm3, $good);
        $stmt->execute();

        // Insertion réponse 4
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, ?)");
        $good = $juste==4?1:0;
        $stmt->bind_param("si", $qcm4, $good);
        $stmt->execute();

        // Insertion réponse 5
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, ?)");
        $good = $juste==5?1:0;
        $stmt->bind_param("si", $qcm5, $good);
        $stmt->execute();

        // Insertion réponse 6
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, ?)");
        $good = $juste==6?1:0;
        $stmt->bind_param("si", $qcm6, $good);
        $stmt->execute();

        // Insertion réponse 7
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, ?)");
        $good = $juste==7?1:0;
        $stmt->bind_param("si", $qcm7, $good);
        $stmt->execute();

        // Insertion réponse 8
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, ?)");
        $good = $juste==8?1:0;
        $stmt->bind_param("si", $qcm8, $good);
        $stmt->execute();

        // Link question and answers

        // get last question inserted
        $stmt = $sql->prepare("select max(question_id) from question");
        $stmt->execute();
        $res = $stmt->get_result();
        $question = $res->fetch_all();
        $question_id = $question[0][0];

        // get last answer inserted
        $stmt = $sql->prepare("select max(answer_id) from answer");
        $stmt->execute();
        $res = $stmt->get_result();
        $answer = $res->fetch_all();
        $answer_id = $answer[0][0];

        for ($i = $answer_id; $i>$answer_id-8; $i--) {
            $stmt = $sql->prepare("INSERT INTO belongs VALUES (?, ?)");
            $stmt->bind_param("ii", $question_id, $i);
            $stmt->execute();
        }

        $stmt->close();

    }

    else {
        die("No database found...");
    }
}

/**
 * Sauvegarde d'une question libre
 * @param $enonce L'énoncé de la question
 * @param $type Le type de la question
 * @param $rep_libre La réponse
 */
function saveQuestionLibre ($enonce, $type, $rep_libre) {
    $sql = connect_db();
    if ($sql != null) {

        // Pour une réponse libre

        // save question
        $stmt = $sql->prepare("INSERT INTO question VALUES (0, ?, ?)");
        $stmt->bind_param("ss", $type, $enonce);
        $stmt->execute();

        // save answer
        $stmt = $sql->prepare("INSERT INTO answer VALUES (0, ?, 1)");
        $stmt->bind_param("s", $rep_libre);
        $stmt->execute();

        // link question and answer

        // get last question inserted
        $stmt = $sql->prepare("select max(question_id) from question");
        $stmt->execute();
        $res = $stmt->get_result();
        $question = $res->fetch_all();
        $question_id = $question[0][0];

        // get last answer inserted
        $stmt = $sql->prepare("select max(answer_id) from answer");
        $stmt->execute();
        $res = $stmt->get_result();
        $answer = $res->fetch_all();
        $answer_id = $answer[0][0];

        $stmt = $sql->prepare("INSERT INTO belongs VALUES (?, ?)");
        $stmt->bind_param("ss", $question_id, $answer_id);
        $stmt->execute();

        $stmt->close();
    }

    else {
        die("No database found...");
    }
}

/**
 * Sauvegarde d'un quiz
 * @param $data Les informations et données qui concernent le quiz
 */
function saveQuiz($data){
    //sauvegarde en bdd le quizz, les questions et les réponses associées

    // sauvegarde du theme
    if($data["theme"] == "nouveau"){
        // la vérif de si le thème n'est pas déjà pris se fait au niveau du
        // navigateur avec le submit
        saveTheme($data);
    }

    //sauvegarde du quizz
    $themeId = getThemeId($data["theme"]);
    $quizTitre = $data["titre"];
    $nbQuestion = getNbQuestion($data);
    $quizDescr = $data["description"];
    $affichage = convertAffichage($data["affichage"]); // 0 pour bloc, 1 pour question par question

    $sql = connect_db();
    $stmt = $sql->prepare("INSERT INTO quizz VALUES(0, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisi", $themeId, $quizTitre, $nbQuestion,
                      $quizDescr, $affichage);
    $stmt->execute();

    // sauvegarde des questions et réponses
    saveAllQuestions($data);

    $stmt->close();
}

/**
 * Récupère l'id d'un thème grâce à son nom
 * @param $themeName Le nom du thème
 * @return L'id du thème
 */
function getThemeId($themeName){
    // récupère l'id du thème en fonction de son nom et de s'il est nouveau

    $sql = connect_db();

    if($themeName == "nouveau"){
        $stmt = $sql->prepare("select max(theme_id) from theme");
    }
    else{
        $stmt = $sql->prepare("select theme_id from theme where theme_name = ?");
        $stmt->bind_param("s", $themeName);
    }

    $stmt->execute();
    $res = $stmt->get_result();
    $idTheme = $res->fetch_all();

    return $idTheme[0][0];
}

/**
 * Sauvegarde d'un nouveau thème
 * @param $data Les informations du nouveau thème
 * @return true si le thème a pu être sauvegardé, false sinon
 */
function saveTheme($data){
    if(isset($data["nomTheme"]) && isset($data["descrTheme"]) && isset($_FILES["imgTheme"]["name"])){
        $allThemes = get_all_themes_names();

        if(!in_array($data["nomTheme"], $allThemes)){
            $themeName = $data["nomTheme"];
            $description = $data["descrTheme"];

            // sauvegarde de l'image et récupération du path de celle-ci
            $imgName = upload_img();
            // sauvegarde du thème
            $sql = connect_db();
            $stmt = $sql->prepare("INSERT INTO theme VALUES(0, ?, ?, ?)");
            $stmt->bind_param("sss", $themeName, $description, $imgName);

            if($stmt->execute()){
                $stmt->close();

                return true;
            }
            else{
                $stmt->close();
                return false;
            }

        }
        else return false;
    }
}

/**
 * Lie une question a un quiz
 * @param $numeroQuestion Le numéro de la question
 */
function linkNewQuestionToQuiz($numeroQuestion){
    // lie la dernière question insérée avec le dernier quiz inséré

    $sql = connect_db();

    // get le dernier quiz ajouté
    $stmt = $sql->prepare("select max(quizz_id) from quizz");
    $stmt->execute();
    $res = $stmt->get_result();
    $idQuiz = $res->fetch_all();
    $idQuiz = $idQuiz[0][0];

    // get la dernière question ajoutée
    $stmt = $sql->prepare("select max(question_id) from question");
    $stmt->execute();
    $res = $stmt->get_result();
    $idQuestion = $res->fetch_all();
    $idQuestion = $idQuestion[0][0];

    // lier la question et le quiz
    $stmt = $sql->prepare("INSERT INTO contain VALUES(?, ?, ?)");
    $stmt->bind_param("iii", $idQuiz, $idQuestion, $numeroQuestion);
    $stmt->execute();

    $stmt->close();
}

/**
 * Lie une question a un quiz
 * @param $idQuestion L'id de la question
 * @param $numeroQuestion Le numéro de la question
 */
function linkExistingQuestionToQuiz($idQuestion, $numeroQuestion){
    // lie la question dont l'id est $idQuestion avec le dernier quiz ajouté

    $sql = connect_db();

    // get le dernier quiz ajouté
    $stmt = $sql->prepare("SELECT max(quizz_id) from quizz");
    $stmt->execute();
    $res = $stmt->get_result();
    $idQuiz = $res->fetch_all();
    $idQuiz = $idQuiz[0][0];

    // get la dernière question ajoutée
    $stmt = $sql->prepare("SELECT question_id from question where question_id=?");
    $stmt->bind_param("i", $idQuestion);
    $stmt->execute();
    $res = $stmt->get_result();
    $idQuestion = $res->fetch_all();
    $idQuestion = $idQuestion[0][0];

    // lier la question et le quiz
    $stmt = $sql->prepare("INSERT INTO contain VALUES(?, ?, ?)");
    $stmt->bind_param("iii", $idQuiz, $idQuestion, $numeroQuestion);
    $stmt->execute();

    $stmt->close();
}
