function surligne(input, erreur) {
    if (erreur) {
        input.classList.remove('input-valide');
        input.classList.add('input-invalide')
    } else {
        input.classList.remove('input-invalide');
        input.classList.add('input-valide')
    }
}

function verifForm(form) {
    let elements = form.elements
    for (let i = 0; i < elements.length; i++) {
        if (elements[i].type !== 'submit') {
            elements[i].onblur;
        }
    }

    let tousOk = true;
    for (let i = 0; i < elements.length; i++) {
        if (elements[i].type !== 'submit' && !elements[i].classList.contains('input-valide')) {
            tousOk = false;
        }
    }
    return tousOk;
}

function verifNonVide(input) {
    surligne(input, input.value === '');
}