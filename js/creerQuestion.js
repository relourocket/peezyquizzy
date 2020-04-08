$.getScript("../js/creerQuiz.js", function(){
    function createQuestion(){
        let questionDiv = $("#Q0");

        insertEnonce(questionDiv, "Q0");
        insertTypeQuestionSelection(questionDiv, "Q0");
    }

    createQuestion();
});
