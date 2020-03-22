function select(questionID){
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
    }
}
