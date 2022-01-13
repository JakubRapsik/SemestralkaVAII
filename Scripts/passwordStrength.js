let strength = {
    1: "Bad ☹",
    2: "Weak ☹",
    3: "Good ☺",
    4: "Strong ☻"
}

let password = document.getElementById('Psw');
let meter = document.getElementById('strength-meter');
let text = document.getElementById('strength-text');

function kontrolaScore(heslo) {
    let score = skore(heslo);
    if (score > 80)
        return 4;
    if (score > 60)
        return 3;
    if (score >= 30)
        return 2;

    return 1;
}

function skore(heslo) {
    let score = 0;
    if (!heslo)
        return score;

    let znaky = new Object();
    for (let i = 0; i < heslo.length; i++) {
        znaky[heslo[i]] = (znaky[heslo[i]] || 0) + 1;
        score += 5.0 / znaky[heslo[i]];
    }

    let variacie = {
        cisla: /\d/.test(heslo),
        male: /[a-z]/.test(heslo),
        velke: /[A-Z]/.test(heslo),
        specZnaky: /\W/.test(heslo),
    }

    let counet = 0;
    for (let kontrola in variacie) {
        counet += (variacie[kontrola] == true) ? 1 : 0;
    }
    score += (counet - 1) * 10;

    return parseInt(score);
}

password.addEventListener('input', function () {

    switch (kontrolaScore(password.value)) {
        case 1: {
            meter.value = 1;
            text.innerHTML = "Strength: " + "<strong>" + strength[1];
            break;
        }
        case 2: {
            meter.value = 2;
            text.innerHTML = "Strength: " + "<strong>" + strength[2];
            break;
        }
        case 3: {
            meter.value = 3;
            text.innerHTML = "Strength: " + "<strong>" + strength[4];
            break;
        }
        case 4: {
            meter.value = 4;
            text.innerHTML = "Strength: " + "<strong>" + strength[4];
            break;
        }
        default: {
            text.innerHTML = "";
            break;
        }
    }

});