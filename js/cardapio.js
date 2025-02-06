preencheTabela();

function preencheTabela(params) {
    fetch('include/Produto/Controlador.php?acao=preencheTabela')
        .then(response => response.text())
        .then(data => {
            document.getElementById('tBody').innerHTML = data
        })
    
}


