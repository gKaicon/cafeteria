carregarTabela()

document.querySelector('#addItensCompra').addEventListener('click', (event) => {
    document.querySelector('.hidden-sub').click()
    if (verificaSelectByID('fornecedor', event) && verificaSelectByID('funcionario', event)) {
        event.preventDefault();
        let dados = {
            dt_compra: document.getElementById('dt_compra').value,
            fornecedor: document.getElementById('fornecedor').value,
            funcionario: document.getElementById('funcionario').value,
        }
        fetch('include/Compra/Controlador.php?acao=inserir', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dados)
        })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok. Error:' + response);
                return response.json();
            })
            .then(data => {
                console.log('Success:', data.result);
                if (data.result.sucesso) {
                    document.getElementById('id').value = data.result.lastId
                    document.getElementById('itens').style.display = 'block';
                }
                data.result.l
            })
            .catch(error => { console.error('Error:', error); });
    }
})

//inserir
document.querySelector('#enviar').addEventListener('click', (event) => {
    document.querySelector('.hidden-sub').click()
    if (verificaSelectByID('produto', event)) {

        event.preventDefault();
        let dados = {
            idProduto: document.getElementById('produto').value,
            qtd: document.getElementById('qtd').value,
            idCompra: document.getElementById('id').value,
        }
        fetch('include/Compra/Controlador.php?acao=inserirItensCompra', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dados)
        })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok. Error:' + response);
            })
            .then(data => { console.log('Success:', data); })
            .catch(error => { console.error('Error:', error); });
        carregarTabela()
    }
})

//listar
function carregarTabela() {
    fetch('include/Compra/Controlador.php?acao=listar')
        .then(response => response.text())
        .then(data => {
            let dados = JSON.parse(data)
            let tabela = document.getElementById('table-list')
            tabela.innerHTML = dados.html
        })
}

function verItensCompra(idCompra) {
    fetch('include/Compra/Controlador.php?acao=listarItensCompra&idCompra=' + idCompra)
        .then(response => response.text())
        .then(data => {
            let dados = JSON.parse(data)
            let tabela = document.getElementById('table-list2')
            document.querySelector('#itensCompraList').style.display = 'block'
            tabela.innerHTML = dados.html
        })
}