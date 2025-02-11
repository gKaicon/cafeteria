<?php
require_once('Produto.class.php');

if ($_REQUEST['acao'] === 'preencheTabela') {
    $controladorProduto = new Produto();
    $result = $controladorProduto->listarParaPreencher();
    $html = '';
    if (!empty($result)) {
        $cont = 0;
        foreach ($result as $value) {
            if ($cont % 4 == 0) {
                $html .= "<tr class='row'>";
            }
            $cont++;
            $caminho = $value['nomeImg'];
            $nome = $value['nome'];
            $descr = $value['descr'];
            $preco = $value['precoVenda'];
            $html .= "
                    <td class='col-3'>
                        <div class='card row'>
                            <div class='content-card col-12'>
                                <img class='img-card' src='../midia/cardapio/$caminho' alt='$nome'>
                                <h3>$nome</h3>
                                <p>$descr</p>
                            </div>
                            <div class='button-card col-12'><button>R$ $preco</button></div>
                        </div>
                    </td>";
            if ($cont % 4 == 0)
                $html .= '</tr>';

        }
    }

    echo $html;
}


if ($_REQUEST['acao'] === 'inserir') {
    $diretorioDestino = '../../../midia/cardapio/';

    $nomeArquivo = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = time() . '-' . $_FILES['imagem']['name'];
        $caminhoArquivo = $diretorioDestino . $nomeArquivo;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoArquivo)) {
            $message = 'Arquivo enviado com sucesso';

        } else {
            $message = 'Erro ao mover o arquivo';
        }
    }
    $message = 'Sem arquivo';
    $dados = json_decode($_POST['dados'], true);

    $p = new Produto();
    $p->setNome($dados['nome']);
    $p->setDescr($dados['descr']);
    $p->setListavel($dados['listavel'] == "1" ? 1 : null);
    $p->setPrecoCusto($dados['preco']);
    $p->setPrecoVenda($dados['preco'] * 1.25);
    $p->setNomeImg($nomeArquivo);
    $p->setFornecedor($dados['fornecedor'] == "" ? null : $dados['fornecedor']);
    $resposta = $p->inserir($p);

    echo json_encode(['result' => $resposta, 'nome_arquivo' => $nomeArquivo, 'message' => $message]);
}


if ($_REQUEST['acao'] == 'update') {
    $dados = json_decode($_POST['dados'], true);

    $diretorioDestino = '../../../midia/cardapio/';

    if ($dados['nomeImg'] == "") {
        $nomeArquivo = null;
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $nomeArquivo = time() . '-' . $_FILES['imagem']['name'];
            $caminhoArquivo = $diretorioDestino . $nomeArquivo;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoArquivo)) {
                $message = 'Arquivo enviado com sucesso';

            } else {
                $message = 'Erro ao mover o arquivo';
            }
        }
    } else {
        $nomeArquivo = $dados['nomeImg'];
    }
    $dados = json_decode($_POST['dados'], true);

    $p = new Produto();
    $p->setId($dados['id']);
    $p->setNome($dados['nome']);
    $p->setDescr($dados['descr']);
    $p->setListavel($dados['listavel'] == "1" ? 1 : null);
    $p->setPrecoCusto($dados['preco']);
    $p->setPrecoVenda($dados['preco'] * 1.25);
    $p->setNomeImg($nomeArquivo);
    $p->setFornecedor($dados['fornecedor'] == "" ? null : $dados['fornecedor']);
    $resposta = $p->update($p);
    $resposta = $resposta == true ? http_response_code(200) : http_response_code(500);
    echo json_encode(['result' => $resposta, 'nome_arquivo' => $nomeArquivo, 'message' => $message]);
}

if ($_REQUEST['acao'] == 'listar') {
    $p = new Produto();
    $result = $p->listar($p);
    if (!empty($result)) {

        $html = "<table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço Custo</th>
                <th>Preço de Venda</th>
                <th>Imagem</th>
                <th>Listavel</th>
                <th>Fornecedor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($result as $value) {
            $nomeImg = $value['nomeImg'];
            $cod = $value['id'];
            $list = $value['listavel'] == 1 ? "Sim" : "Não";
            $obj[$cod] = $value;

            $html .= "<tr>
                        <td>" . $value['id'] . "</td>
                        <td>" . $value['nome'] . "</td>
                        <td>" . $value['descr'] . "</td>
                        <td>R$ " . $value['precoCusto'] . "</td>
                        <td>R$ " . $value['precoVenda'] . "</td>
                        <td>" . $value['nomeImg'] . "</td>
                        <td>" . $list . "</td>
                        <td>" . $value['fornecedor'] . "</td>";
            $html .= "  <td>
                            <button id='editar' onclick='editar($cod)'><img src='../midia/icons/pencil-solid.svg' height='20px'></button>
                            <button id='excluir' onclick='deletar($cod, `$nomeImg`)'><img src='../midia/icons/trash-solid.svg' height='20px'></button>
                        </td>";
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";
        echo json_encode(['html' => $html, 'dados' => $obj]);
    }
}



if ($_REQUEST['acao'] === 'excluirArquivo') {
    $idDoRegistro = $_REQUEST['id'];
    $nomeDoArquivo = $_REQUEST['arquivo'];

    $p = new Produto();
    $p->setId($idDoRegistro);

    if ($p->deleteIMG($p)) {
        excluirArquivo($nomeDoArquivo);
    } else {
        echo json_encode(['mensagem' => 'Erro ao excluir o registro']);
    }
}


if ($_REQUEST['acao'] === 'delete') {
    $idDoRegistro = $_REQUEST['id'];
    $nomeDoArquivo = $_REQUEST['arquivo'];

    $p = new Produto();
    $p->setId($idDoRegistro);

    if ($p->delete($p)) {
        excluirArquivo($nomeDoArquivo);
    } else {
        echo json_encode(['mensagem' => 'Erro ao excluir o registro']);
    }
}

if ($_REQUEST['acao'] === 'listarCombo') {
    $p = new Produto();
    $result = $p->listarCombo($p);
    if (!empty($result)) {
        $html = "<option value='0'>Escolher...</option>";
        foreach ($result as $value) {
            $html .= "<option value='" . $value['id'] . "'>" . $value['nome'] . "</option>";
        }
    }
    echo json_encode(["html" => $html]);
}


function excluirArquivo($nomeArquivo)
{
    $caminhoArquivo = '../../../midia/cardapio/' . $nomeArquivo;
    if (file_exists($caminhoArquivo)) {
        if (unlink($caminhoArquivo)) {
            echo json_encode(['mensagem' => 'Arquivo excluído com sucesso']);
        } else {
            echo json_encode(['mensagem' => 'Erro ao excluir o arquivo']);
        }
    } else {
        echo json_encode(['mensagem' => 'Arquivo não encontrado']);
    }
}