function deleteQuiz(idQuiz){
    // envoie une requête fetch au serveur pour effacer un quiz de la bdd
    //  et efface dans le DOM le quiz correspondant

    fetch(`../server_side/delete_quiz.php?id=${idQuiz}`);

    $(`#quiz${idQuiz}`).remove();
}
