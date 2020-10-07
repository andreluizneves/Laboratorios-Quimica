function selecao() {

    var imagem = document.getElementById("imagem");
    var rm = document.getElementById('rm');
    var ra = document.getElementById('ra');
    var seletor = document.getElementById('my-select').value

    if (seletor == "professor(a)") {
        imagem.setAttribute('src', '../recursos/img/mestres.svg')
        rm.style.display = "none"
        ra.style.display = "block"
    } else {
        imagem.setAttribute('src', '../recursos/img/alunos.svg')
        rm.style.display = "block"
        ra.style.display = "none"
    }
}