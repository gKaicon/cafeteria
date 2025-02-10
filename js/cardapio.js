preencheTabela();

window.addEventListener('scroll', function () {
    let posicaoScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (posicaoScroll > 60){
        document.querySelector('nav').style.position = 'fixed'
        document.querySelector('nav').style.top = '0'
        document.querySelector('nav').style.left = '0'
        document.querySelector('nav').style.right = '0'
        document.querySelector('nav .left').style.position = 'fixed'
        
    }
    else{
        document.querySelector('nav').style.position = 'static'
    }
})

function preencheTabela() {
    fetch('include/Produto/Controlador.php?acao=preencheTabela')
        .then(response => response.text())
        .then(data => {
            document.getElementById('tBody').innerHTML = data
            ajustaTabela();
        })

}

function ajustaTabela() {
    arraytr = document.querySelectorAll('#tBody tr')
    arraytr.forEach(tr => {
        if (tr.children.length == 1) {
            let htmlTR = tr.innerHTML;
            let novoHTML = `<td class="col-2" style="margin: 10.5%;"></td>${htmlTR}`
            tr.innerHTML = novoHTML
        }
        else if (tr.children.length == 2) {
            let htmlTR = tr.innerHTML;
            let novoHTML = `<td class="col-3"></td>${htmlTR}`
            tr.innerHTML = novoHTML
        }
        else if (tr.children.length == 3) {
            let htmlTR = tr.innerHTML;
            let novoHTML = `<td class="col-2" style="margin: -2.5%;"></td>${htmlTR}`
            tr.innerHTML = novoHTML
        }
    })
}