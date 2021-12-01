let strength = {
    0: "Worst ☹",
    1: "Bad ☹",
    2: "Weak ☹",
    3: "Good ☺",
    4: "Strong ☻"
}

let password = document.getElementById('Psw');
let meter = document.getElementById('strength-meter');
let text = document.getElementById('strength-text');

password.addEventListener('input', function () {
    let hodnotahesla = password.value;
    let vysledok = zxcvbn(hodnotahesla);

    meter.value = vysledok.score;

    if (hodnotahesla !== "") {
        text.innerHTML = "Strength: " + "<strong>" + strength[vysledok.score] +
            "</strong>" + "<span class='feedback'>" + vysledok.feedback.warning +
            " " + vysledok.feedback.suggestions + "</span";
    } else {
        text.innerHTML = "";
    }
});