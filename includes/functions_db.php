<?php

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
        unset($answers["idquizz"]); //unset pour éviter de gérer l'id du quiz dans la recherche

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

function save_score ($points, $quizzid, $pseudo) {
    $sql = connect_db();
    if ($sql != null) {
        $stmt = $sql->prepare("INSERT INTO score VALUES (0, ?, ?, ?)");
        $stmt->bind_param("iii", $userid, intval($quizzid), $points);
        $userid = get_user_id($pseudo)[0][0];
        $stmt->execute();
        $stmt->close();
    } else {
        die("No database found...");
    }
}

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

function get_all_scores_by_user ($user) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT quizz.quizz_id, quizz.quizz_titre, MAX(score_points), quizz.quizz_nbquestions from score, quizz, contain where quizz.quizz_id = score.score_quizz and score_user = ? GROUP BY quizz.quizz_id");
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

function saveAllQuestions($data){
    // sauvegarde toutes les questions et les lie au
    // questionnaire auquel elles appartiennent

    // on obtient toutes les questions du quiz
    $regexQuestion = "#^typeQuestionQ[0-9]+$#";
    $questions = array();
    foreach($data as $key => $val){
        if(preg_match($regexQuestion, $key)){
            array_push($questions, substr($key, 12));
        }
    }

    $numeroQuestion = 1; // indice pour la sauvegarde dans la table contain

    foreach($questions as $q){
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
            linkQuestionToQuiz($numeroQuestion);

        }
        $numeroQuestion++;
    }
}

function saveQcm ($enonce, $qcm1, $qcm2, $qcm3, $qcm4, $qcm5, $qcm6, $qcm7, $qcm8, $juste) {
    // Sauvegarde une question de type QCM ainsi que toutes ses réponses
    // associées

    $sql = connect_db();
    if ($sql != null) {

        $type = "qcm";

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
    $difficulte = convertDifficulte($data["difficulte"]);
    $affichage = convertAffichage($data["affichage"]); // 0 pour bloc, 1 pour question par question

    $sql = connect_db();
    $stmt = $sql->prepare("INSERT INTO quizz VALUES(0, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisii", $themeId, $quizTitre, $nbQuestion,
                      $quizDescr, $difficulte, $affichage);
    $stmt->execute();

    // sauvegarde des questions et réponses
    saveAllQuestions($data);

    $stmt->close();
}

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

function linkQuestionToQuiz($numeroQuestion){
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
