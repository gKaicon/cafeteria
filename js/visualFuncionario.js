document.getElementById('salvar').style.display = 'none'

carregarTabela()

//inserir
document.querySelector('#enviar').addEventListener('click', (event) => {
    document.querySelector('.hidden-sub').click()
    event.preventDefault();
    let dados = {
        nome: document.getElementById('nome').value,
        cpf: document.getElementById('cpf').value,
        cargo: document.getElementById('cargo').value,
        telefone: document.getElementById('telefone').value,
        email: document.getElementById('email').value,
    }
    fetch('include/Funcionario/Controlador.php?acao=inserir', {
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
    document.getElementById('id').value = ""
    document.getElementById('nome').value = ""
    document.getElementById('cargo').value = ""
    document.getElementById('telefone').value = ""
    document.getElementById('email').value = ""
    document.getElementById('cpf').value = ""

    fetch('include/Funcionario/Controlador.php?acao=listar')
        .then(response => response.text())
        .then(data => {
            let dados = JSON.parse(data)
            let tabela = document.getElementById('table-list')
            tabela.innerHTML = dados.html
        })
}

//carregar dados para Editar
function editar(id) {
    document.getElementById('id').value = id
    fetch('include/Funcionario/Controlador.php?acao=getByID&id=' + id + '', {
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
            console.log(data);

            document.getElementById('id').value = id
            document.getElementById('nome').value = data.result.nome
            document.getElementById('cargo').value = data.result.cargo
            document.getElementById('telefone').value = data.result.telefone
            document.getElementById('email').value = data.result.email
            document.getElementById('cpf').value = data.result.cpf

            document.getElementById('enviar').style.display = 'none'
            document.getElementById('salvar').style.display = 'block'
        })
}


//atualizar
document.querySelector("#salvar").addEventListener('click', (event) => {
    event.preventDefault();
    document.querySelector('.hidden-sub').click()
    let id = document.getElementById('id').value
    let dados = {
        nome: document.getElementById('nome').value,
        cpf: document.getElementById('cpf').value,
        cargo: document.getElementById('cargo').value,
        telefone: document.getElementById('telefone').value,
        email: document.getElementById('email').value,
    }

    fetch('include/Funcionario/Controlador.php?acao=update&id=' + id + '', {
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
function excluir(id) {
    if (window.confirm("Tem certeza que deseja apagar?")) {
        fetch('include/Funcionario/Controlador.php?acao=delete&id=' + id + '', {
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
