function select() {
    var type = document.getElementById('typeQuestion');
    var type_value = type.options[type.selectedIndex].value;

    if (type_value == "radio") {
        document.getElementById('qcm').classList.add('show');
        if (document.getElementById('libre').classList.contains('show')) {
            document.getElementById('libre').classList.remove('show');
        }
    }
    else if (type_value == "libre") {
        document.getElementById('libre').classList.add('show');
        if (document.getElementById('qcm').classList.contains('show')) {
            document.getElementById('qcm').classList.remove('show');
        }
    }
}

/*for (var i = 0; i < buttons.length; i++) {
    var button = buttons[i];
    button.addEventListener('click', function() {
        var target = this.getAttribute('data-next');
        for (var j = 0; j < questions.length; j++) {
            var question = questions[j];
            if (question.id == target) {
                question.classList.add('show');
            } else if (question.classList.contains('show')) {
                question.classList.remove('show');
            }
        }
    });
}*/