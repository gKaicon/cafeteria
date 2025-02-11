let arrayEdicao;

document.getElementById("salvar").style.display = "none";
document.getElementById('nomeImg').style.display = 'none'
document.querySelectorAll(".imagem").forEach((imagem) => (imagem.style.display = "none"));

carregarTabela()
verificaCheckBox();

function verificaCheckBox() {
  return document.getElementById("list").checked == true;
}

document.querySelector("form").addEventListener("click", (event) => {
  if (verificaCheckBox()) {
    document.getElementById("listavel").value = "1"
    document.querySelectorAll(".imagem").forEach((imagem) => (imagem.style.display = "block"));
  } else {
    document.getElementById("listavel").value = "0"
    document.querySelectorAll(".imagem").forEach((imagem) => (imagem.style.display = "none"));
  }
});

document.getElementById("listavel").addEventListener("change", function () {
  document.getElementById("list").checked = this.value === "1";
});

//inserir
document.querySelector("#enviar").addEventListener("click", (event) => {

  if (verificaSelectByID('fornecedor', event)) {
    document.querySelector('.hidden-sub').click()
    event.preventDefault();
    const formulario = document.getElementById("form-cadastro");
    const dados = {};
    const formData = new FormData();

    const campos = formulario.querySelectorAll("input, select");
    campos.forEach((campo) => {
      if (campo.type === "file") {
        formData.append(campo.name, campo.files[0]);
      } else {
        dados[campo.name] = campo.value;
      }
    });

    const dadosJSON = JSON.stringify(dados);
    formData.append("dados", dadosJSON);

    fetch("include/Produto/Controlador.php?acao=inserir", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          return response.text().then((err) => {
            throw new Error(
              "Network response was not ok. Error:" +
              response.status +
              " - " +
              err
            );
          });
        }
        return response.json();
      })
      .then((data) => {
        console.log("Success:", data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
    carregarTabela()
  }
});

//listar
function carregarTabela() {
  document.getElementById('excluir-img').style.display = 'none'
  document.getElementById('id').value = ""
  document.getElementById('nomeImg').value = ""
  document.getElementById('nome').value = ""
  document.getElementById('descr').value = ""
  document.getElementById('preco').value = ""
  document.getElementById('fornecedor').value = ""
  document.getElementById('listavel').value = ""
  document.getElementById('list').checked = false

  document.getElementById('enviar').style.display = 'block'
  document.getElementById('salvar').style.display = 'none'
  fetch('include/Produto/Controlador.php?acao=listar')
    .then(response => response.text())
    .then(data => {
      let dados = JSON.parse(data)
      let tabela = document.getElementById('table-list')
      tabela.innerHTML = dados.html
      arrayEdicao = dados.dados
    })
}



// //carregar dados para Editar
function editar(id) {
  document.getElementById('enviar').style.display = 'none'
  document.getElementById('salvar').style.display = 'block'
  if (arrayEdicao[id].nomeImg != null) {
    document.getElementById('excluir-img').style.display = 'block'
  }
  document.getElementById('id').value = id
  document.getElementById('nomeImg').value = arrayEdicao[id].nomeImg
  document.getElementById('nome').value = arrayEdicao[id].nome
  document.getElementById('descr').value = arrayEdicao[id].descr
  document.getElementById('preco').value = arrayEdicao[id].precoCusto
  document.getElementById('fornecedor').value = arrayEdicao[id].idFornecedor
  document.getElementById('listavel').value = arrayEdicao[id].listavel

  document.getElementById('list').checked = arrayEdicao[id].listavel == 1 ? true : false

  document.getElementById('enviar').style.display = 'none'
  document.getElementById('nomeImg').style.display = 'block'
  document.getElementById('salvar').style.display = 'block'

  window.scrollTo({
    top: 0,
    left: 0,
    behavior: 'smooth'
  });
}

//atualizar
document.querySelector("#salvar").addEventListener('click', (event) => {
  event.preventDefault();
  if (verificaSelectByID('fornecedor', event)) {
    document.querySelector('.hidden-sub').click()
    const formulario = document.getElementById("form-cadastro");
    const dados = {};
    const formData = new FormData();

    const campos = formulario.querySelectorAll("input, select");
    campos.forEach((campo) => {
      if (campo.type === "file") {
        formData.append(campo.name, campo.files[0]);
      } else {
        dados[campo.name] = campo.value;
      }
    });

    const dadosJSON = JSON.stringify(dados);
    formData.append("dados", dadosJSON);
    console.log(formData);
    let id = document.getElementById('id').value
    fetch('include/Produto/Controlador.php?acao=update&id=' + id + '', {
      method: "POST",
      body: formData,
    }).then(response => response.text())
      .then((data) => {
        console.log("Success:", data);
        carregarTabela()
        window.scrollTo({
          bottom: 0,
          behavior: 'smooth'
        });
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
})


document.getElementById('excluir-img').addEventListener('click', (event) => {
  event.preventDefault();
  let id = document.getElementById('id').value
  let nomeImg = document.getElementById('nomeImg').value
  deletarImg(id, nomeImg)
})

//deletar Imagem
function deletarImg(id, nomeImg) {
  event.preventDefault();
  if (window.confirm(`Tem certeza que deseja apagar a imagem: ${nomeImg}?`)) {
    fetch('include/Produto/Controlador.php?acao=excluirArquivo&arquivo=' + nomeImg + '&id=' + id + '', {
    }).then(response => {
      if (!response.ok)
        throw new Error('Network response was not ok. Error:' + response);
    }).then(data => {
      console.log('Success:', data);
      document.getElementById('nomeImg').value = ""
    }).catch(error => {
      console.error('Error:', error);
    });
    carregarTabela()
  }
}

//deletar
function deletar(id, nomeImg) {
  event.preventDefault();
  if (window.confirm("Tem certeza que deseja apagar?")) {
    fetch('include/Produto/Controlador.php?acao=delete&id=' + id + '&arquivo=' + nomeImg + '', {
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