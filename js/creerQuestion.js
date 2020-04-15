/*
* Récupère l'ensemble des scripts nécessaires pour insérer les champs utiles à la création
* d'une nouvelle question personnalisée. Ensuite, insert les éléments dans le DOM.
*/

$.getScript("../js/creerQuiz.js", function(){
    function createQuestion(){
        let questionDiv = $("#createQuestionQ0");

        insertEnonce(questionDiv, "Q0");
        insertTypeQuestionSelection(questionDiv, "Q0");
    }

    createQuestion();
});
