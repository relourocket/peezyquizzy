<?php

function connect_db () {
    $mysqli = new mysqli("localhost", "root", "", "myquizz");
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

function get_quizz_questions ($quizzid) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("select * from quizz, question, contain where quizz.quizz_id = ? and quizz.quizz_id = contain.quizz_id and question.question_id = contain.question_id");
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
    $score = 0;
    $i = 0;
    $sql = connect_db();
    if ($sql != null) {

        // prepare and bind
        $stmt = $sql->prepare("select contain.question_numero, answer.answer_enonce from question, answer, belongs, contain, quizz 
        where answer.answer_id = belongs.answer_id and question.question_id = belongs.question_id
        and question.question_id = contain.question_id and quizz.quizz_id = contain.quizz_id and quizz.quizz_id = ? and answer.answer_istrue = 1");
        $stmt->bind_param("s", $answers['idquizz']);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $awnswers_true = $result->fetch_all(); // fetch data
        $stmt->close();


        foreach ($answers as $answer) {
            if ($i < count($answers)-1) {
                if (strcmp(strtolower($answer), strtolower($awnswers_true[$i][1])) == 0) {
                    $score++;
                }
            }
            $i++;
        }

        return $score;

    } else {
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

function save_score ($points, $temps, $quizzid, $pseudo) {
    $sql = connect_db();
    if ($sql != null) {
        $stmt = $sql->prepare("INSERT INTO score VALUES (0, ?, ?, ?, ?)");
        $stmt->bind_param("iiii", $userid, intval($quizzid), $temps, $points);
        $userid = get_user_id($pseudo)[0][0];
        $stmt->execute();
        $stmt->close();
    } else {
        die("No database found...");
    }
}

function get_best_score ($user) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT max(score_points) FROM score WHERE score_user = ?");
        $stmt->bind_param("i", $userid);
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

function get_best_time ($user) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("SELECT min(score_temps) FROM score WHERE score_user = ?");
        $stmt->bind_param("i", $userid);
        $userid = get_user_id($user)[0][0];
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $best_time = $result->fetch_all(); // fetch data
        $stmt->close();

        return $best_time[0][0];

    } else {
        die("No database found...");
    }
}

function get_all_score ($user) {
    $sql = connect_db();
    if ($sql != null) {
        // prepare and bind
        $stmt = $sql->prepare("select quizz.quizz_id, quizz.quizz_titre, score_points from score, quizz where quizz.quizz_id = score.score_quizz and score_user = ?");
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