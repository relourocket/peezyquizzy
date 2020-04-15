/* Créer la base de données myquizz si elle n'existe pas et l'encoder en UTF-8 */
CREATE DATABASE IF NOT EXISTS myquizz;
ALTER DATABASE myquizz charset=utf8;

/* Création de la table users */
CREATE TABLE IF NOT EXISTS users (
  user_id INTEGER AUTO_INCREMENT PRIMARY KEY,
  user_login VARCHAR(100) NOT NULL,
  user_password VARCHAR(100) NOT NULL,
  user_isadmin BOOLEAN NOT NULL
);

/* Création de la table theme */
CREATE TABLE IF NOT EXISTS theme (
	theme_id INTEGER AUTO_INCREMENT PRIMARY KEY,
    theme_name VARCHAR(100) NOT NULL,
    theme_description VARCHAR(300) NOT NULL,
    theme_image LONGBLOB NOT NULL /* Chemin vers l'image en question */
);

/* Création de la table question */
CREATE TABLE IF NOT EXISTS question (
	question_id INTEGER AUTO_INCREMENT PRIMARY KEY,
    question_type VARCHAR(50) NOT NULL,
    question_enonce VARCHAR(300) NOT NULL
);

/* Création de la table quizz qui contient comme clé  étrangère l'id du thème */
CREATE TABLE IF NOT EXISTS quizz (
	quizz_id INTEGER AUTO_INCREMENT PRIMARY KEY,
    quizz_theme INTEGER NOT NULL,
    quizz_titre VARCHAR(150) NOT NULL,
    quizz_nbquestions INTEGER NOT NULL,
    quizz_description VARCHAR(300) NOT NULL,
    quizz_affichage INTEGER NOT NULL, /* 1 pour affichage entier, 2 pour affichage question par question */
    FOREIGN KEY (quizz_theme) REFERENCES theme(theme_id)
);

/* Création de la table score avec comme clés étrangères l'id d'un utilisateur et d'un quiz */
CREATE TABLE IF NOT EXISTS score (
	score_id INTEGER AUTO_INCREMENT PRIMARY KEY,
    score_user INTEGER NOT NULL,
    score_quizz INTEGER NOT NULL,
    score_points INTEGER NOT NULL,
    score_difficulte VARCHAR(9) NOT NULL,
    FOREIGN KEY (score_user) REFERENCES users(user_id),
    FOREIGN KEY (score_quizz) REFERENCES quizz(quizz_id)
);

/* Création de la table contain qui relie les quiz aux questions */
CREATE TABLE IF NOT EXISTS contain (
	quizz_id INTEGER NOT NULL,
    question_id INTEGER NOT NULL,
    question_numero INTEGER NOT NULL, /* Le numéro de la question dans le quiz */
    FOREIGN KEY (quizz_id) REFERENCES quizz(quizz_id),
    FOREIGN KEY (question_id) REFERENCES question(question_id)
);

/* Création de la table answer */
CREATE TABLE IF NOT EXISTS answer (
	answer_id INTEGER AUTO_INCREMENT PRIMARY KEY,
    answer_enonce VARCHAR(300) NOT NULL,
    answer_istrue BOOLEAN NOT NULL
);

/* Création de la table belongs qui relie les questions et les réponses */
CREATE TABLE IF NOT EXISTS belongs (
	question_id INTEGER NOT NULL,
    answer_id INTEGER NOT NULL,
    FOREIGN KEY (question_id) REFERENCES question(question_id),
    FOREIGN KEY (answer_id) REFERENCES answer(answer_id)
);
