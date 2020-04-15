/*
* Renvoie un div contenant les champs pour créer un thème de quiz
* @return createThemeDiv un div contenant l'ensemble des éléments nécessaires pour créer un thème
*/
function insertCreateTheme(){
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
    imgThemeInput.id = "upload";
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

/*
* insert un module de création de question. L'utilisateur peut choisir entre
* prendre une question déjà existante ou en créer une.
*/
function insertQuestion(){
    let questionDiv = $("#addQuestion");
    let newQuestionDiv = document.createElement("div");
    newQuestionDiv.setAttribute("class", "question");

    //on assigne des id de question pour pouvoir les sélectionner pour les effacer
    let nbQuestions = $(".question").length;
    let questionID = "Q".concat(nbQuestions);
    newQuestionDiv.setAttribute("id", questionID);

    questionDiv.append(newQuestionDiv);

    // select pour choisir parmi toutes les questions
    let selectQuestionDiv = document.createElement("div");
    selectQuestionDiv.className = "form-group row";
    selectQuestionDiv.id = "divSelectQuestion".concat(questionID)

    let selectQuestionLabel = document.createElement("label");
    selectQuestionLabel.className = "col-form-label col-sm-4";
    selectQuestionLabel.textContent = "Votre question :";

    let selectQuestion = document.createElement("select");
    selectQuestion.id = "selectQuestion".concat(questionID);
    selectQuestion.required = true;
    selectQuestion.className = "form-control col-sm-8";
    selectQuestion.setAttribute("name", questionID);
    selectQuestion.setAttribute("onchange", `changeCreateQuestion('${questionID}')`);

    newQuestionDiv.append(selectQuestionDiv);
    selectQuestionDiv.append(selectQuestionLabel);
    selectQuestionDiv.append(selectQuestion);

    // insertion des options
    let defaultOption = document.createElement("option");
    defaultOption.setAttribute("value", "");
    defaultOption.textContent = "-- Choisissez votre question --";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    selectQuestion.append(defaultOption);

    let nouveauOption = document.createElement("option");
    nouveauOption.setAttribute("value", "nouveau");
    nouveauOption.textContent = "Nouvelle Question";
    selectQuestion.append(nouveauOption);

    // on récupère les options avec une requête ajax vers le serveur
    fetch("../server_side/get_questions.php")
    .then(function(result){
        return result.json();
    })
    .then(function(questions){
        for(q of questions){
            let questionOption = document.createElement("option");
            questionOption.setAttribute("value", q[0]);
            questionOption.textContent = q[2];

            selectQuestion.append(questionOption);
        }
    });

    //création du bouton pour remove la question
    let removeBtn = document.createElement("button");
    removeBtn.innerHTML = "Effacer la question";
    removeBtn.setAttribute("class", "removeBtn btn");
    removeBtn.setAttribute("id", "removeBtn".concat(questionID));
    removeBtn.setAttribute("onclick", `removeQuestion('${questionID}')`);

    //on met un type button pour empêcher de submit lorsque l'on clique dessus
    removeBtn.setAttribute("type", "button");

    //append le boutton à la question
    questionDiv.append(removeBtn);
}

/*
* Fonction onchange vérifiant si l'utilisateur veut créer une question n'existant pas encore,
* et modifie le DOM en ajoutant ou supprimant les champs pour créer une question personnalisée
*/
function changeCreateQuestion(questionID){
    // vérifie si l'utilisateur veut créer une nouvelle question et modifie
    // le DOM en ajoutant ou en supprimant la possibilité de créer une question
    // personnalisée

    let nouvelleQuestionVal = $(`#selectQuestion${questionID}`).val();
    // console.log(nouvelleQuestionVal);
    if(nouvelleQuestionVal === "nouveau"){
        insertCreateQuestion(questionID);
    }
    else{
        $(`#createQuestion${questionID}`).remove();
    }

}

/*
* Insert les éléments nécessaires pour créer une question personnalisée
*/
function insertCreateQuestion(questionID){
    let createQuestionDiv = document.createElement("div");
    createQuestionDiv.id = `createQuestion${questionID}`;

    insertEnonce(createQuestionDiv, questionID);
    insertTypeQuestionSelection(createQuestionDiv, questionID);

    $(`#${questionID}`).append(createQuestionDiv);
}

/*
* Insert les champs pour créer un énoncé de question dans le DOM
*/
function insertEnonce(createQuestionDiv, questionID){
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
    enonceInput.setAttribute("id", `enonce${questionID}`);

    // insertion
    enonce.append(enonceLabel);
    enonce.append(enonceInput);
    createQuestionDiv.append(enonce);
}

/*
* Insert un élément de type select pour choisir le type de la question créée
*/
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
    typeSelect.insertAdjacentHTML("beforeend", "<option value='' selected disabled>Type de Question </option>");

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

/*
* Renvoie un ensemble d'éléments pour créer une réponse libre pour une question
* @return libre un div contenant des éléments label et input pour créer une réponse textuelle
*/
function insertLibre(questionID){
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

    return libre;
}

/*
* Renvoie un div contenant les champs nécessaires pour créer les réponses d'un QCM
* @return qcm un div contenant l'ensemble des éléments pour créer les réponses d'un QCM
*/
function insertQcm(questionID, nbRep){
    // insert un emplacement pour les réponses d'un QCM

    let qcm = document.createElement("div");
    qcm.id = `qcm${questionID}`;

    for(let i = 1; i < nbRep+1; i++){
        insertQcmRep(qcm, questionID, i);
    }

    return qcm;
}

/*
* Insert les input et label d'une réponse d'un QCM
* @param qcmDiv le div dans lequel insérer les éléments pour la création de réponse
* @param questionID une string du type "Q0" indiquant l'id de la question
* @param indiceRep le numéro de la réponse dans la question donnée
*/
function insertQcmRep(qcmDiv, questionID, indiceRep){
    let repQCM = document.createElement("div");
    repQCM.className = "repQcm";
    repQCM.id = `repQcm${indiceRep}${questionID}`;

    let qcmRepDiv = document.createElement("div");
    qcmRepDiv.className = "form-group row"
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

    // choix si c'est la bonne réponse
    let justeDiv = document.createElement("div");
    justeDiv.className = "form-group row goodAnswer";

    // label
    let justeLabel = document.createElement("label");
    justeLabel.className = "col-sm-2";
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
    qcmRepDiv.append(qcmLabel);
    qcmRepDiv.append(qcmInput);

    justeDiv.append(justeLabel);
    justeDiv.append(justeInput);

    repQCM.append(qcmRepDiv);
    repQCM.append(justeDiv);
    qcmDiv.append(repQCM);
}

/*
* Fonction onclick retirant du DOM la question associée au bouton activé.
* Le conteneur retiré est identifié grâce à son id contenant à la fin un string du type "Q0".
* @param questionID l'id de la question à enlever du DOM. Par exemple "Q0" ou "Q10".
*/
function removeQuestion(questionID){
        $("#".concat(questionID)).remove();
        $("#removeBtn".concat(questionID)).remove();

        changeQuestionsElements();
}

/*
* Fonction appelée lors de la suppression d'une question dans le DOM. Change tous les id des éléments
* terminant par un string du type "Q0" pour assurer la cohérence dans les numéros de question.
*/
function changeQuestionsElements(){
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

        // changement onchange pour sélectionner la question voulue
        $(`#selectQuestion${newQuestionID}`).attr("onchange", `changeCreateQuestion('${newQuestionID}')`);
    });


}

/*
* Au onchange du select pour choisir le type de question voulu, met à jour le DOM en ajoutant
* ou supprimant les éléments correspondant au type de question choisi
* @param questionID une string du type "Q0" indiquant l'id de la question
*/
function selectType(questionID){
    let type = $("#typeQuestion".concat(questionID));

    switch(type.val()){
        case "libre":
            $("#createQuestion".concat(questionID)).append(insertLibre(questionID));
            $("#qcm".concat(questionID)).remove();
            break;

        case "qcm":
            $("#createQuestion".concat(questionID)).append(insertQcm(questionID, 8));
            $("#libre".concat(questionID)).remove();
            break;

        case "typeQ":
            $("#qcm".concat(questionID)).remove();
            $("#libre".concat(questionID)).remove();
            break;

    }
}

/*
* Insert ou supprime dans le DOM les éléments nécessaires pour créer un nouveau thème personnalisé.
* La fonction est appelé au onchange d'un select.
*/
function selectTheme(){
    let themeValue = $("#themeSelect").val();

    if (themeValue === "nouveau"){
        $("#theme").after(insertCreateTheme());
    }

    else {
        $("#createTheme").remove();
    }
}

/*
* Fonction de vérification de différents éléments au niveau des inputs lors de la création d'un quiz
*/
function checkForm(){
    // vérifie que tout est ok dans le form pour la validation
    let isOk = true;

    // vérification de si le thème choisi n'existe pas déjà
    if($("#createTheme").length === 1){
        let nouveauTheme = $("#nomTheme").val();
        let options = $("#themeSelect")[0].options;

        for(let i = 0; i < options.length; i++){
            let optionValue = options[i].getAttribute("value");
            if(nouveauTheme === optionValue){
                isOk = false;
                $("#erreur").empty();
                $("#erreur").append("Le thème sélectionné existe déjà <br>" );
            }
        }
    }

    // vérification qu'il existe des questions dans le form
    let nbQuestions = $(".question").length;
    if(nbQuestions === 0){
        isOk = false;
        $("#erreur").empty();
        $("#erreur").append("Votre questionnaire ne contient aucune question ! <br>");
    }

    // vérifie si les questions ont des réponses
    else{
        $(".question").each(function(){
            let idQuestion = this.id;
            let checkQcm = $(`#qcm${idQuestion}`).length;
            let checkLibre = $(`#libre${idQuestion}`).length;
            let checkQuestion = $(`#selectQuestion${idQuestion}`).val() === "nouveau"; //bool

            console.log(checkQuestion);
            if(checkQuestion && checkQcm != 1 && checkLibre != 1){
                isOk = false;
                $("#erreur").empty();
                $("#erreur").append("Certaines de vos questions ne contiennent pas de réponse(s) <br>");
            }
        });
    }

    // vérification de si on upload qu'une seule image + de l'extension + de la taille
    if($("#upload").length != 0){
        if($("#upload")[0].files.length != 1){
            isOk = false;
            $("#erreur").empty();
        }
        else {
            let file = $("#upload")[0].files[0];

            // vérif extension
            let validExtensions = ["jpeg", "jpg", "png"];
            let splittedName = file.name.split(".")
            let fileExtension = splittedName[splittedName.length - 1].toLowerCase();

            if(!validExtensions.includes(fileExtension)){
                isOk = false;
                $("#erreur").empty();
                $("#erreur").append("L'image uploadée n'a pas une extension valide <br>" );
            }

            // vérif poids de l'image
            let fileSize = file.size;
            if(fileSize > 4194304){
                isOk = false;
                $("#erreur").empty();
                $("#erreur").append("L'image uploadée est trop lourde (> 4Mo) <br>" );
            }
        }
    }

    // vérifie que tous les inputs sont non vides
    let regex = new RegExp("^[ ]+$");
    $("input").each(function(){
        let value = $(this).val();
        if(regex.test(value)){
            isOk = false;
            $("#erreur").empty();
            $("#erreur").append("Un de vos champs est vide <br>" );
        }
    });



    return isOk;
}
