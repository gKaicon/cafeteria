let allGasto = 0;
let gastoCompra = 0;
let gastoGastos = 0;

let arrayGastos = {};

document.querySelectorAll('details').forEach(details => {
    details.open = true
})

document.getElementById('salvar').style.display = 'none'

preencheTabelaGastos()
preencheTabelaCompras()

function preencheTabelaCompras() {
    fetch('include/Compra/Controlador.php?acao=listarComprasUltimoMes')
        .then(response => response.json())
        .then(data => {
            const html = data.html;
            const gastos = document.getElementById('compras-ultimo-mes');
            gastos.innerHTML = html
            gastoCompra = data.dados.total.total
            atualizaGasto()
        })
}

function preencheTabelaGastos() {
    fetch('include/Gasto/Controlador.php?acao=listarGastosUltimoMes')
        .then(response => response.text())
        .then(data => {
            data = JSON.parse(data)
            const html = data.html;
            const gastos = document.getElementById('gastos-ultimo-mes');
            gastos.innerHTML = html
            gastoGastos = data.dados.total.total

            data.dados.lista.forEach(e => {
                console.log(e);
                arrayGastos[`${e.id}`] = {
                    descr: e.descr,
                    dt_gasto: e.dt_gasto,
                    valor_gasto: e.valor_gasto
                }
            })
            atualizaGasto()
            resetaForm()
        })
}

function atualizaGasto(tipo) {
    allGasto = 0
    allGasto = parseFloat(gastoCompra) + parseFloat(gastoGastos)
    const gastoTotal = document.querySelector('.gasto-total');
    gastoTotal.innerHTML = `R$ ${allGasto.toFixed(2)}`
}



document.querySelector('#enviar').addEventListener('click', (event) => {
    event.preventDefault();
    let dados = {
        descr: document.getElementById('descr').value,
        dt_gasto: document.getElementById('dt_gasto').value,
        valor_gasto: document.getElementById('valor_gasto').value
    }
    fetch('include/Gasto/Controlador.php?acao=inserir', {
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
    preencheTabelaGastos()
})


function editar(id) {
    console.log(arrayGastos);
    document.getElementById('id').value = id
    document.getElementById('descr').value = arrayGastos[id].descr
    document.getElementById('dt_gasto').value = arrayGastos[id].dt_gasto
    document.getElementById('valor_gasto').value = arrayGastos[id].valor_gasto
    document.getElementById('enviar').style.display = 'none'
    document.getElementById('salvar').style.display = 'block'

}


document.querySelector("#salvar").addEventListener('click', (event) => {
    event.preventDefault();
    let id = document.getElementById('id').value
    let dados = {
        descr: document.getElementById('descr').value,
        dt_gasto: document.getElementById('dt_gasto').value,
        valor_gasto: document.getElementById('valor_gasto').value
    }
    fetch('include/Gasto/Controlador.php?acao=update&id=' + id + '', {
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
    preencheTabelaGastos()
})

function deletar(id) {
    if (window.confirm("Tem certeza que deseja apagar?")) {
        fetch('include/Gasto/Controlador.php?acao=delete&id=' + id + '', {
        }).then(response => {
            if (!response.ok)
                throw new Error('Network response was not ok. Error:' + response);
        }).then(data => {
            console.log('Success:', data);
        }).catch(error => {
            console.error('Error:', error);
        });
        preencheTabelaGastos()
    }
}

function resetaForm() {
    document.getElementById('id').value = ""
    document.getElementById('descr').value = ""
    document.getElementById('dt_gasto').value = ""
    document.getElementById('valor_gasto').value = ""
    document.getElementById('enviar').style.display = 'block'
    document.getElementById('salvar').style.display = 'none'
}