<?php
require_once('Produto.class.php');

if ($_REQUEST['acao'] === 'preencheTabela') {
    $controladorProduto = new Produto();
    $result = $controladorProduto->listarParaPreencher();
    $result[''];
    $html = '';
    if (!empty($result)) {
        $cont = 0;
        foreach ($result as $value) {
            if ($cont % 4 == 0)
                $html .= "<tr class='row'>";

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


if ($_REQUEST['acao'] === 'insert') {

    $pastaDestino = '../../../midia/cardapio';


    if (isset($_FILES['imagem']) && !empty($_FILES['imagem']['name'])) {
        // Pega informações do arquivo
        $nomeArquivo = $_FILES['imagem']['name'];
        $tipoArquivo = $_FILES['imagem']['type'];
        $tamanhoArquivo = $_FILES['imagem']['size'];
        $tmpNome = $_FILES['imagem']['tmp_name'];

        // Verifica o tipo do arquivo (opcional)
        $extensoesPermitidas = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($tipoArquivo, $extensoesPermitidas)) {
            echo 'Tipo de arquivo inválido.';
            exit;
        }

        // Gera um novo nome para o arquivo (opcional) para evitar sobreposição
        $novoNome = uniqid() . '_' . $nomeArquivo;

        // Move o arquivo para a pasta de destino
        move_uploaded_file($tmpNome, $pastaDestino . $novoNome);

        echo 'Arquivo enviado com sucesso!';

        // Inserir informações no banco de dados (opcional)
        // ...
    } else {
        echo 'Nenhum arquivo selecionado.';
    }
}
?>