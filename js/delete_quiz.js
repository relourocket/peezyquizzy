/*
* Envoie une requête fetch au serveur pour effacer un quiz de la bdd
* et efface dans le DOM le quiz correspondant.
* @param idQuiz l'id du quiz à effacer en bdd
*/
function deleteQuiz(idQuiz){
    fetch(`../server_side/delete_quiz.php?id=${idQuiz}`);

    $(`#quiz${idQuiz}`).remove();
}
