document.getElementById('salvar').style.display = 'none'

carregarTabela()

//inserir
document.querySelector('#enviar').addEventListener('click', (event) => {
    event.preventDefault();
    let dados = {
        _: document.getElementById('').value,
    }
    fetch('include/___/Controlador.php?acao=inserir', {
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
})

//listar
function carregarTabela() {
    document.getElementById('enviar').style.display = 'block'
    document.getElementById('salvar').style.display = 'none'

    document.getElementById('').value = ""
    
    fetch('include/___/Controlador.php?acao=listar')
        .then(response => response.text())
        .then(data => {
            let dados = JSON.parse(data)
            let tabela = document.getElementById('table-list')
            tabela.innerHTML = dados.html
        })
}

//carregar dados para Editar
function editarPessoa(id) {
    document.getElementById('codigo').value = id
    fetch('include/___/Controlador.php?acao=getByID', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: id
        })
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById('').value = data[0]._
            
            document.getElementById('enviar').style.display = 'none'
            document.getElementById('salvar').style.display = 'block'
        })
}


//atualizar
document.querySelector("#salvar").addEventListener('click', (event) => {
    event.preventDefault();
    let id = document.getElementById('id').value
    let dados = {
        _: document.getElementById('').value,
    }

        fetch('include/___/Controlador.php?acao=update&id=' + id + '', {
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
})

//deletar
function deletarPessoa(id) {
    if (window.confirm("Tem certeza que deseja apagar?")) {
        fetch('include/___/Controlador.php?acao=delete&id=' + id + '', {
        }).then(response => {
            if (!response.ok)
                throw new Error('Network response was not ok. Error:' + response);
        }).then(data => {
            console.log('Success:', data);
        }).catch(error => {
            console.error('Error:', error);
        });
        carregarTabela()
    }
}
