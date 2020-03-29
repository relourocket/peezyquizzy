function insertCreateTheme(){
    //renvoie un div contenant les champs pour créer un thème


    // conteneur de la création de thème
    let createThemeDiv = document.createElement("div");
    createThemeDiv.id = "createTheme";

    // nom du thème
    let nomThemeDiv = document.createElement("div");
    nomThemeDiv.className = "form-group row";

    let nomThemeLabel = document.createElement("label");
    nomThemeLabel.className = "col-form-label col-sm-3";
    nomThemeLabel.setAttribute("for", "nomTheme");
    nomThemeLabel.textContent = "Nom du thème";

    let nomThemeInput = document.createElement("input");
    nomThemeInput.id = "nomTheme";
    nomThemeInput.className = "form-control col-sm-9";
    nomThemeInput.setAttribute("name", "nomTheme");
    nomThemeInput.required = true;

    nomThemeDiv.append(nomThemeLabel);
    nomThemeDiv.append(nomThemeInput);

    // description
    let descrThemeDiv = document.createElement("div");
    descrThemeDiv.className = "form-group row";

    let descrThemeLabel = document.createElement("label");
    descrThemeLabel.className = "col-form-label col-sm-3";
    descrThemeLabel.setAttribute("for", "descrTheme");
    descrThemeLabel.textContent = "Description";

    let descrThemeInput = document.createElement("input");
    descrThemeInput.id = "descrTheme";
    descrThemeInput.className = "form-control col-sm-9";
    descrThemeInput.setAttribute("name", "descrTheme");
    descrThemeInput.required = true;

    descrThemeDiv.append(descrThemeLabel);
    descrThemeDiv.append(descrThemeInput);

    // image
    let imgThemeDiv = document.createElement("div");
    imgThemeDiv.className = "form-group row";

    let imgThemeLabel = document.createElement("label");
    imgThemeLabel.className = "col-form-label col-sm-3";
    imgThemeLabel.textContent = "Image illustrative";

    let imgThemeInput = document.createElement("input");
    imgThemeInput.className = "col-sm-9";
    imgThemeInput.setAttribute("type", "file");
    imgThemeInput.setAttribute("name", "imgTheme");
    imgThemeInput.required = true;

    imgThemeDiv.append(imgThemeLabel);
    imgThemeDiv.append(imgThemeInput);

    // insertion
    createThemeDiv.append(nomThemeDiv);
    createThemeDiv.append(descrThemeDiv);
    createThemeDiv.append(imgThemeDiv);

    return createThemeDiv;
}

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
    insertTypeQuestionSelection(newQuestionDiv, questionID);

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

function insertTypeQuestionSelection(newQuestionDiv, questionID){
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
    typeSelect.setAttribute("onchange", `selectType('${questionID}')`);

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
    justeInput.setAttribute("name", `juste${questionID}`);
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
        $("#typeQuestion".concat(newQuestionID)).attr("onchange", `selectType('${newQuestionID}')`);
    });


}

function selectType(questionID){
    let type = $("#typeQuestion".concat(questionID));

    switch(type.val()){
        case "libre":
            $("#".concat(questionID)).append(insertLibre(questionID));
            $("#qcm".concat(questionID)).remove();
            break;

        case "qcm":
            $("#".concat(questionID)).append(insertQcm(questionID, 8));
            $("#libre".concat(questionID)).remove();
            break;

        case "typeQ":
            $("#qcm".concat(questionID)).remove();
            $("#libre".concat(questionID)).remove();
            break;

    }
}

function selectTheme(){
    let themeValue = $("#themeSelect").val();

    if (themeValue === "nouveau"){
        $("#theme").after(insertCreateTheme());
    }

    else {
        $("#createTheme").remove();
    }
}
