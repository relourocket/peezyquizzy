function insertQuestion(){
    // Insert une question à l'appel d'un onclick

    let questionDiv = $("#addQuestion");
    let newQuestionDiv = document.createElement("div");
    newQuestionDiv.setAttribute("class", "question");

    //on assigne des id de question pour pouvoir les sélectionner pour les effacer
    let nbQuestions = $(".question").length;
    let questionID = "Q".concat(nbQuestions);
    newQuestionDiv.setAttribute("id", questionID);

    questionDiv.append(newQuestionDiv);

    insertEnonce(newQuestionDiv, questionID);
    insertTypeSelection(newQuestionDiv, questionID);

    //création du bouton pour remove la question
    let removeBtn = document.createElement("button");
    removeBtn.innerHTML = "Effacer la question";
    removeBtn.setAttribute("class", "removeBtn");
    removeBtn.setAttribute("id", "removeBtn".concat(questionID));
    removeBtn.setAttribute("onclick", `removeQuestion('${questionID}')`);

    //on met un type button pour empêcher de submit à l'appui
    removeBtn.setAttribute("type", "button");

    //append le boutton à la question
    questionDiv.append(removeBtn);



}

function insertEnonce(newQuestionDiv, questionID){
    let enonce = document.createElement("div");
    enonce.className = "form-group row";

    // création du label
    let enonceLabel = document.createElement("label");
    enonceLabel.className = "col-sm-3 col-form-label";
    enonceLabel.setAttribute("for", `enonce${questionID}`);
    enonceLabel.textContent = "Enoncé";

    // création input
    let enonceInput = document.createElement("input");
    enonceInput.className = "form-control col-sm-9";
    enonceInput.setAttribute("type", "text");
    enonceInput.setAttribute("name", `enonce${questionID}`);
    enonceInput.setAttribute("id", "enonce");

    // insertion
    enonce.append(enonceLabel);
    enonce.append(enonceInput);
    newQuestionDiv.append(enonce);
}

function insertTypeSelection(newQuestionDiv, questionID){
    let questionType = document.createElement("div");
    questionType.className = "form-group row";

    // création du label
    let typeLabel = document.createElement("label");
    typeLabel.className = "col-sm-3 col-form-label";
    typeLabel.setAttribute("for", "typeQuestion");
    typeLabel.textContent = "Type";

    // création select
    let typeSelect = document.createElement("select");
    typeSelect.className = "form-control col-sm-9";
    typeSelect.setAttribute("type", "text");
    typeSelect.setAttribute("name", `typeQuestion${questionID}`);
    typeSelect.setAttribute("id", `typeQuestion${questionID}`);
    typeSelect.setAttribute("onchange", `select('${questionID}')`);

    //création des options
    typeSelect.insertAdjacentHTML("beforeend", "<option selected value='typeQ'>Type de Question </option>");
    let option1 = document.createElement("option");
    option1.setAttribute("value", "libre");
    option1.textContent = "Réponse libre";

    let option2 = document.createElement("option");
    option2.setAttribute("value", "qcm");
    option2.textContent = "QCM";


    typeSelect.append(option1);
    typeSelect.append(option2);

    // insertion
    questionType.append(typeLabel);
    questionType.append(typeSelect);
    newQuestionDiv.append(questionType);
}

function insertLibre(questionID){
    // return un div contenant une réponse libre
    let libre = document.createElement("div");
    libre.id = `libre${questionID}`;

    // un conteneur pour aligner input et label correctement
    let wrapperLibre = document.createElement("div");
    wrapperLibre.className = "form-group row";

    // création du label
    let libreLabel = document.createElement("label");
    libreLabel.className = "col-sm-3 col-form-label";
    libreLabel.setAttribute("for", "repLibre");
    libreLabel.textContent = "Réponse";

    // création input
    let libreInput = document.createElement("input");
    libreInput.className = "form-control col-sm-9";
    libreInput.setAttribute("type", "text");
    libreInput.setAttribute("name", `repLibre${questionID}`);
    libreInput.setAttribute("id", "repLibre");
    libreInput.required = true;

    // insertion
    wrapperLibre.append(libreLabel);
    wrapperLibre.append(libreInput)
    libre.append(wrapperLibre);
    // newQuestionDiv.append(libre);
    return libre;
}

function insertQcm(questionID, nbRep){
    let qcm = document.createElement("div");
    qcm.id = `qcm${questionID}`;

    for(let i = 1; i < nbRep+1; i++){
        insertQcmRep(qcm, questionID, i);
    }

    return qcm;
}

function insertQcmRep(qcmDiv, questionID, indiceRep){
    let repQCM = document.createElement("div");
    repQCM.className = "form-group row";
    repQCM.id = `repQcm${indiceRep}${questionID}`;

    // libellé de la rep
    // label
    let qcmLabel = document.createElement("label");
    qcmLabel.className = "col-sm-3 col-form-label";
    qcmLabel.setAttribute("for", `rep${indiceRep}${questionID}`);
    qcmLabel.textContent = `Réponse ${indiceRep}`;

    // input
    let qcmInput = document.createElement("input");
    qcmInput.className = "form-control col-sm-8";
    qcmInput.setAttribute("type", "text");
    qcmInput.setAttribute("name", `rep${indiceRep}${questionID}`);
    qcmInput.setAttribute("id", `rep${indiceRep}${questionID}`);
    qcmInput.required = true;

    // choix si c'est la bonne rep
    let justeDiv = document.createElement("div");
    justeDiv.className = "col-sm-12 goodAnswer";

    // label
    let justeLabel = document.createElement("label");
    justeLabel.className = "col-sm-3";
    justeLabel.setAttribute("for", `justeRep${indiceRep}${questionID}`);
    justeLabel.textContent = "Réponse juste  ";

    // input
    // let justeInputDiv = document.createElement("div");
    let justeInput = document.createElement("input");
    justeInput.id = `justeRep${indiceRep}${questionID}`;
    justeInput.className = "col-sm-1";
    justeInput.setAttribute("type", "radio");
    justeInput.setAttribute("name", "juste");
    justeInput.setAttribute("value",`${indiceRep}`);
    justeInput.required = true;

    // insertion
    repQCM.append(qcmLabel);
    repQCM.append(qcmInput);

    justeDiv.append(justeLabel);
    justeDiv.append(justeInput);

    repQCM.append(justeDiv);
    qcmDiv.append(repQCM);
}

function removeQuestion(questionID){
        $("#".concat(questionID)).remove();
        $("#removeBtn".concat(questionID)).remove();

        changeQuestions();
}

function changeQuestions(){
    // change les attributs des éléments pour avoir une continuité dans les questions

    let nbQuestions = $(".question").length;
    let indiceQuestion = 0;

    $(".question").each(function(indiceQuestion){

        let idActuel = this.id; //id du conteneur de la n-ième question

        let newQuestionID = "Q".concat(indiceQuestion);

        // changement de tous les éléments finissant par l'ID
        $(`[name$='${idActuel}']`).each(function(){
            let nameActuel = $(this).attr("name");
            let newName = nameActuel.substring(0, nameActuel.length-2).concat(newQuestionID);

            $(this).attr("name", newName);
        });

        $(`[id$='${idActuel}']`).each(function(){
            let nameActuel = $(this).attr("id");
            let newName = nameActuel.substring(0, nameActuel.length-2).concat(newQuestionID);

            $(this).attr("id", newName);
        });

        $(`[for$='${idActuel}']`).each(function(){
            let nameActuel = $(this).attr("for");
            let newName = nameActuel.substring(0, nameActuel.length-2).concat(newQuestionID);

            $(this).attr("for", newName);
        });

        // Changement du bouton pour effacer la question
        // on met le nouvel ID pour sélectionner car celui-ci a déjà été changé
        $("#removeBtn".concat(newQuestionID)).attr("onclick", `removeQuestion('${newQuestionID}')`);

        // changement du onchange pour sélectionner le type
        $("#typeQuestion".concat(newQuestionID)).attr("onchange", `select('${newQuestionID}')`);
    });


}
