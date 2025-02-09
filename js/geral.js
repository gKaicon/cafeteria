if (document.getElementById('cpf')) {
    document.getElementById('cpf').addEventListener('input', () => {
        function mascaraCPF(cpf) {
            cpf = cpf.replace(/\D/g, '');
            if (cpf.length <= 11)
                return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        }
        document.getElementById('cpf').value = mascaraCPF(document.getElementById('cpf').value);
    });
}


if (document.getElementById('telefone')) {
    document.getElementById('telefone').addEventListener('input', () => {
        function mascaraTelefone(telefone) {
            telefone = telefone.replace(/\D/g, '');
            if (telefone.length <= 10)
                return telefone.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
            else
                return telefone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
        }
        document.getElementById('telefone').value = mascaraTelefone(document.getElementById('telefone').value);
    });
}

if (document.getElementById('cnpj')) {

    document.getElementById('cnpj').addEventListener('input', () => {
        function mascaraCNPJ(cnpj) {
            cnpj = cnpj.replace(/\D/g, '');
            if (cnpj.length <= 14) {
                return cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            }
            return cnpj;
        }

        document.getElementById('cnpj').value = mascaraCNPJ(document.getElementById('cnpj').value);
    });
}

if (document.getElementById('cep')) {
    document.getElementById('cep').addEventListener('input', () => {
        function mascaraCEP(cep) {
            cep = cep.replace(/\D/g, '');
            if (cep.length <= 8) {
                return cep.replace(/(\d{5})(\d{3})/, '$1-$2');
            } else {
                return cep.slice(0, 8).replace(/(\d{5})(\d{3})/, '$1-$2');
            }
        }

        document.getElementById('cep').value = mascaraCEP(document.getElementById('cep').value);
    });
}

if (document.querySelector('.decimal10-2')) {
    const input = document.querySelector('.decimal10-2');
    input.addEventListener('input', () => {
        function mascaraValor(valor) {
            valor = valor.replace(/\D/g, '');

            if (valor.length <= 2) {
                return valor;
            } else {
                const parteInteira = valor.slice(0, -2);
                const parteDecimal = valor.slice(-2);
                return parteInteira + '.' + parteDecimal;
            }
        }
        input.value = mascaraValor(input.value);
    })
}

if (document.getElementById('fornecedor')) {
    let comboFornecedor = document.getElementById('fornecedor')
    fetch('include/Fornecedor/Controlador.php?acao=listarCombo')
        .then(response => response.text())
        .then(data => {
            let dados = JSON.parse(data)
            comboFornecedor.innerHTML = dados.html
        })
}

if (document.getElementById('produto')) {
    let comboFornecedor = document.getElementById('produto')
    fetch('include/Produto/Controlador.php?acao=listarCombo')
        .then(response => response.text())
        .then(data => {
            let dados = JSON.parse(data)
            comboFornecedor.innerHTML = dados.html
        })
}

if (document.getElementById('funcionario')) {
    let comboFornecedor = document.getElementById('funcionario')
    fetch('include/Funcionario/Controlador.php?acao=listarCombo')
        .then(response => response.text())
        .then(data => {
            let dados = JSON.parse(data)
            comboFornecedor.innerHTML = dados.html
        })
}

function verificaSelectByID(idSelect, event) {
    const select = document.getElementById(idSelect);

    if (select.value == '0') {
        event.preventDefault();
        alert('Selecione uma opção no campo ' + idSelect);
        return false
    }
    return true
}