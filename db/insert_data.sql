INSERT INTO theme VALUES (0, "Culture générale", "Testez votre culture générale !", "/images/cultureg.jpg");

INSERT INTO question VALUES (0, "libre", "Qui raconte les aventures de Sherlock Holmes ?");
INSERT INTO question VALUES (0, "radio", "Qui fût le quarantième président des Etats-Unis ?");
INSERT INTO question VALUES (0, "radio", "Quel est le plus long fleuve en Europe occidentale ?");
INSERT INTO question VALUES (0, "libre", "Quel est le nom du docteur dans Cluedo ?");
INSERT INTO question VALUES (0, "radio", "Complétez ce célèbre slogan : \" ... Coca-Cola\"");
INSERT INTO question VALUES (0, "libre", "Quel est le nom officiel du terrain de tennis ?");
INSERT INTO question VALUES (0, "radio", "En combien de temps la Terre tourne-t-elle autour du Soleil ?");
INSERT INTO question VALUES (0, "libre", "Quelle ville a construit le premier métro ?");
INSERT INTO question VALUES (0, "radio", "De quoi se nourrit le manchot ?");
INSERT INTO question VALUES (0, "radio", "Combien y a t-il de joueurs sur le terrain dans une équipe de base-ball ?");

INSERT INTO answer VALUES (0, "Watson", true);

INSERT INTO answer VALUES (0, "George Washington", false);
INSERT INTO answer VALUES (0, "Thomas Jefferson", false);
INSERT INTO answer VALUES (0, "Abraham Lincoln", false);
INSERT INTO answer VALUES (0, "Theodore Roosevelt", false);
INSERT INTO answer VALUES (0, "Franklin Delano Roosevelt", false);
INSERT INTO answer VALUES (0, "Ronald Reagan", true);
INSERT INTO answer VALUES (0, "George H. W. Bush", false);
INSERT INTO answer VALUES (0, "Barack Obama", false);

INSERT INTO answer VALUES (0, "Rhin", false);
INSERT INTO answer VALUES (0, "Danube", false);
INSERT INTO answer VALUES (0, "Volga", true);
INSERT INTO answer VALUES (0, "Oural", false);
INSERT INTO answer VALUES (0, "Don", false);
INSERT INTO answer VALUES (0, "Kama", false);
INSERT INTO answer VALUES (0, "Oka", false);
INSERT INTO answer VALUES (0, "Loire", false);

INSERT INTO answer VALUES (0, "Olive", true);

INSERT INTO answer VALUES (0, "Always", true);
INSERT INTO answer VALUES (0, "Fresh", false);
INSERT INTO answer VALUES (0, "Love", false);
INSERT INTO answer VALUES (0, "Life", false);
INSERT INTO answer VALUES (0, "Share", false);
INSERT INTO answer VALUES (0, "Psssht", false);
INSERT INTO answer VALUES (0, "Drink", false);
INSERT INTO answer VALUES (0, "Care", false);

INSERT INTO answer VALUES (0, "Court", true);

INSERT INTO answer VALUES (0, "365 jours", false);
INSERT INTO answer VALUES (0, "364 jours", false);
INSERT INTO answer VALUES (0, "364 jours et quart", false);
INSERT INTO answer VALUES (0, "365 jours et quart", true);
INSERT INTO answer VALUES (0, "366 jours", false);
INSERT INTO answer VALUES (0, "Ca dépend des années", false);
INSERT INTO answer VALUES (0, "366 jours et quart", false);
INSERT INTO answer VALUES (0, "365 jours et demi", false);

INSERT INTO answer VALUES (0, "Londres", true);

INSERT INTO answer VALUES (0, "De poisson", false);
INSERT INTO answer VALUES (0, "De manchots", false);
INSERT INTO answer VALUES (0, "De glace", false);
INSERT INTO answer VALUES (0, "De phoques", false);
INSERT INTO answer VALUES (0, "De carcasses d\'animaux", false);
INSERT INTO answer VALUES (0, "D\'eau uniquement", false);
INSERT INTO answer VALUES (0, "De plancton", true);
INSERT INTO answer VALUES (0, "De plantes", false);

INSERT INTO answer VALUES (0, "8", false);
INSERT INTO answer VALUES (0, "12", false);
INSERT INTO answer VALUES (0, "9", true);
INSERT INTO answer VALUES (0, "20", false);
INSERT INTO answer VALUES (0, "18", false);
INSERT INTO answer VALUES (0, "14", false);
INSERT INTO answer VALUES (0, "6", false);
INSERT INTO answer VALUES (0, "21", false);

INSERT INTO belongs VALUES (1,1);
INSERT INTO belongs VALUES (2,2);
INSERT INTO belongs VALUES (2,3);
INSERT INTO belongs VALUES (2,4);
INSERT INTO belongs VALUES (2,5);
INSERT INTO belongs VALUES (2,6);
INSERT INTO belongs VALUES (2,7);
INSERT INTO belongs VALUES (2,8);
INSERT INTO belongs VALUES (2,9);
INSERT INTO belongs VALUES (3,10);
INSERT INTO belongs VALUES (3,11);
INSERT INTO belongs VALUES (3,12);
INSERT INTO belongs VALUES (3,13);
INSERT INTO belongs VALUES (3,14);
INSERT INTO belongs VALUES (3,15);
INSERT INTO belongs VALUES (3,16);
INSERT INTO belongs VALUES (3,17);
INSERT INTO belongs VALUES (4,18);
INSERT INTO belongs VALUES (5, 19);
INSERT INTO belongs VALUES (5, 20);
INSERT INTO belongs VALUES (5, 21);
INSERT INTO belongs VALUES (5, 22);
INSERT INTO belongs VALUES (5, 23);
INSERT INTO belongs VALUES (5, 24);
INSERT INTO belongs VALUES (5, 25);
INSERT INTO belongs VALUES (5, 26);
INSERT INTO belongs VALUES (6, 27);
INSERT INTO belongs VALUES (7, 28);
INSERT INTO belongs VALUES (7, 29);
INSERT INTO belongs VALUES (7, 30);
INSERT INTO belongs VALUES (7, 31);
INSERT INTO belongs VALUES (7, 32);
INSERT INTO belongs VALUES (7, 33);
INSERT INTO belongs VALUES (7, 34);
INSERT INTO belongs VALUES (7, 35);
INSERT INTO belongs VALUES (8, 36);
INSERT INTO belongs VALUES (9, 37);
INSERT INTO belongs VALUES (9, 38);
INSERT INTO belongs VALUES (9, 39);
INSERT INTO belongs VALUES (9, 40);
INSERT INTO belongs VALUES (9, 41);
INSERT INTO belongs VALUES (9, 42);
INSERT INTO belongs VALUES (9, 43);
INSERT INTO belongs VALUES (9, 44);
INSERT INTO belongs VALUES (10, 45);
INSERT INTO belongs VALUES (10, 46);
INSERT INTO belongs VALUES (10, 47);
INSERT INTO belongs VALUES (10, 48);
INSERT INTO belongs VALUES (10, 49);
INSERT INTO belongs VALUES (10, 50);
INSERT INTO belongs VALUES (10, 51);
INSERT INTO belongs VALUES (10, 52);

INSERT INTO quizz VALUES (0, 1, "Quizz de culture générale", 10, "Testez votre culture générale avec ce quizz !", 1, 1);

INSERT INTO contain VALUES (1, 1, 1);
INSERT INTO contain VALUES (1, 2, 2);
INSERT INTO contain VALUES (1, 3, 3);
INSERT INTO contain VALUES (1, 4, 4);
INSERT INTO contain VALUES (1, 5, 5);
INSERT INTO contain VALUES (1, 6, 6);
INSERT INTO contain VALUES (1, 7, 7);
INSERT INTO contain VALUES (1, 8, 8);
INSERT INTO contain VALUES (1, 9, 9);
INSERT INTO contain VALUES (1, 10, 10);

INSERT INTO users VALUES (0, "agass", "motdepasse", true);
INSERT INTO users VALUES (0, "aparize", "motdepasse", true);
INSERT INTO users VALUES (0, "gdupont", "123456789", false);

