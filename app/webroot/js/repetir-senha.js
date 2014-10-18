var senha, repetir_senha, igual, diferente, form_end;

$(document).ready(function() {
    senha = document.getElementById('senha');
    repetir_senha = document.getElementById('repetir-senha');
    form_end = document.getElementById('form-end');
    igual = "#66cc66";
    diferente = "#ff6666";
    verifica_senha();
});

function verifica_senha() {
    var s1 = senha.value;
    var s2 = repetir_senha.value;
    if (s1 == s2 && s1 != '' && s2 != '') {
        senha.style.backgroundColor = igual;
        repetir_senha.style.backgroundColor = igual;
        form_end.disabled = false;
    } else {
        senha.style.backgroundColor = diferente;
        repetir_senha.style.backgroundColor = diferente;
        form_end.disabled = true;
    }
}