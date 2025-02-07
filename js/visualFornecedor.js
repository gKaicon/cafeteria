document.getElementById('salvar').style.display = 'none'
resetaFormEndereco()
carregarTabela()

let acao = ''

//inserir
document.querySelector('#enviar').addEventListener('click', (event) => {
    event.preventDefault();
    let dados = {
        cep: document.querySelector('#cep').value,
        cnpj: document.querySelector('#cnpj').value,
        razao_social: document.querySelector('#razao_social').value,
        email: document.querySelector('#email').value,
        telefone: document.querySelector('#telefone').value,
        logradouro: document.querySelector('#logradouro').value,
        num: document.querySelector('#num').value,
        bairro: document.querySelector('#bairro').value,
        cidade: document.querySelector('#cidade').value,
        uf: document.querySelector('#uf').value,
        codigo_municipio: document.querySelector('#codigo_municipio').value,
        complemento: document.querySelector('#complemento').value
    }

    fetch('include/Fornecedor/Controlador.php?acao=inserir', {
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
    resetaForm()

    fetch('include/Fornecedor/Controlador.php?acao=listar')
        .then(response => response.text())
        .then(data => {
            data = JSON.parse(data)
            let tabela = document.getElementById('table-list')
            tabela.innerHTML = data.html
        })
}

//carregar dados para Editar
function editar(id) {
    document.getElementById('id').value = id
    fetch('include/Fornecedor/Controlador.php?acao=getByID&id=' + id + '', {
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
            document.querySelector('#id').value = id
            document.querySelector('#cep').value = data.result.cep
            document.querySelector('#cnpj').value = data.result.cnpj
            document.querySelector('#cnpj').setAttribute('disabled', 'disabled')
            document.querySelector('#razao_social').value = data.result.razao_social
            document.querySelector('#email').value = data.result.email
            document.querySelector('#telefone').value = data.result.telefone
            document.querySelector('#logradouro').value = data.result.logradouro
            document.querySelector('#num').value = data.result.num
            document.querySelector('#bairro').value = data.result.bairro
            document.querySelector('#cidade').value = data.result.cidade
            document.querySelector('#uf').value = data.result.UF
            document.querySelector('#codigo_municipio').value = data.result.codigo_municipio
            document.querySelector('#complemento').value = data.result.complemento

            document.getElementById('enviar').style.display = 'none'
            document.getElementById('salvar').style.display = 'block'
        })
}


//atualizar
document.querySelector("#salvar").addEventListener('click', (event) => {
    event.preventDefault();
    let id = document.getElementById('id').value
    let dados = {
        cep: document.querySelector('#cep').value,
        razao_social: document.querySelector('#razao_social').value,
        email: document.querySelector('#email').value,
        telefone: document.querySelector('#telefone').value,
        logradouro: document.querySelector('#logradouro').value,
        num: document.querySelector('#num').value,
        bairro: document.querySelector('#bairro').value,
        cidade: document.querySelector('#cidade').value,
        uf: document.querySelector('#uf').value,
        codigo_municipio: document.querySelector('#codigo_municipio').value,
        complemento: document.querySelector('#complemento').value
    }

    fetch('include/Fornecedor/Controlador.php?acao=update&id=' + id + '', {
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
function deletar(id) {
    if (window.confirm("Tem certeza que deseja apagar?")) {
        fetch('include/Fornecedor/Controlador.php?acao=delete&id=' + id + '', {
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



document.getElementById("cep").addEventListener("keyup", function () {
    if (this.value.length === 9) {
        let cep = this.value.replace("-", "");
        let url = "https://viacep.com.br/ws/" + cep + "/json/"
        fetch(url, {})
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if (data.erro === "true") {

                }
                else {
                    if (acao === 'u') {

                    }
                    else {
                        resetaFormEndereco();
                        (data.logradouro === "") ? document.querySelector("#logradouro").removeAttribute("disabled") : document.querySelector("#logradouro").value = (data.logradouro);
                        (data.bairro === "") ? document.querySelector("#bairro").removeAttribute("disabled") : document.querySelector("#bairro").value = (data.bairro);
                        document.querySelector("#cidade").value = (data.localidade);
                        document.querySelector("#uf").value = (data.uf);
                        document.querySelector("#codigo_municipio").value = (data.ibge);
                    }
                }
            }).catch(error => {
                console.error('Error:', error);
            });
    }
});

function resetaForm() {
    resetaFormEndereco();
    document.querySelector('#cep').value = ""
    document.querySelector('#cnpj').value = ""
    document.querySelector('#cnpj').removeAttribute('disabled')
    document.querySelector('#razao_social').value = ""
    document.querySelector('#email').value = ""
    document.querySelector('#telefone').value = ""
}

function resetaFormEndereco() {
    document.querySelector('#logradouro').setAttribute('disabled', 'disabled')
    document.querySelector('#bairro').setAttribute('disabled', 'disabled')
    document.querySelector('#cidade').setAttribute('disabled', 'disabled')
    document.querySelector('#uf').setAttribute('disabled', 'disabled')
    document.querySelector('#logradouro').value = ""
    document.querySelector('#num').value = ""
    document.querySelector('#bairro').value = ""
    document.querySelector('#cidade').value = ""
    document.querySelector('#uf').value = ""
    document.querySelector('#codigo_municipio').value = ""
    document.querySelector('#complemento').value = ""
}