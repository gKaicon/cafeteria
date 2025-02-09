<?php

require_once 'Fornecedor.class.php';


if($_REQUEST['acao'] == 'inserir'){
    $dados = json_decode(file_get_contents('php://input'),true);
    $f = new Fornecedor();
    $f->setRazaoSocial($dados['razao_social']);
    $f->setCnpj($dados['cnpj']);
    $f->setLogradouro($dados['logradouro']);
    $f->setNum($dados['num']);
    $f->setBairro($dados['bairro']);
    $f->setCidade($dados['cidade']);
    $f->setComplemento($dados['complemento']);
    $f->setUf($dados['uf']);
    $f->setCep($dados['cep']);
    $f->setTelefone($dados['telefone']);
    $f->setEmail($dados['email']);
    $result = $f->inserir($f);

    echo json_encode(['result' => $result]);
}   

if($_REQUEST['acao'] == 'update'){
    $dados = json_decode(file_get_contents('php://input'),true);
    $f = new Fornecedor();
    $f->setId($_REQUEST['id']);
    $f->setRazaoSocial($dados['razao_social']);
    $f->setLogradouro($dados['logradouro']);
    $f->setNum($dados['num']);
    $f->setBairro($dados['bairro']);
    $f->setCidade($dados['cidade']);
    $f->setComplemento($dados['complemento']);
    $f->setUf($dados['uf']);
    $f->setCep($dados['cep']);
    $f->setTelefone($dados['telefone']);
    $f->setEmail($dados['email']);
    $result = $f->update($f);
    
    echo json_encode(['result' => $result]);
}   



if ($_REQUEST['acao'] == 'listar') {
    $f = new Fornecedor();
    $result = $f->listar();
    if ($result) {
        $html = '<table>
        <thead>
            <tr>
                <th>CNPJ</th>
                <th>Razao Social</th>
                <th>Telefone</th>
                <th>Email</th>    
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($result as $value) {
            $id = $value['id'];
            $array["$id"] = $value;
            $html .= "<tr>";
            $html .= "<td>" . $value['cnpj'] . "</td>";
            $html .= "<td>" . $value['razao_social'] . "</td>";
            $html .= "<td>" . $value['telefone'] . "</td>";
            $html .= "<td>" . $value['email'] . "</td>";
            $html .= "<td>" . $value['logradouro'] . ", " . $value['num'] . ", " . $value['bairro'] . ", " . $value['cidade'] . ", " . $value['UF'] . ", " . $value['cep'] . "</td>";
            $html .= "<td>
                            <button id='editar' onclick='editar(" . $value['id'] . ")'><img src='../midia/icons/pencil-solid.svg' height='20px'></button>
                            <button id='excluir' onclick='deletar(" . $value['id'] . ")'><img src='../midia/icons/trash-solid.svg' height='20px'></button>
                      </td>";
            $html .= "</tr>";
        }
        $html .= '</tbody></table>';
        echo json_encode(['html' => $html]);

    }
}

if($_REQUEST['acao'] == 'getByID'){    
    $f = new Fornecedor();
    $f->setId($_REQUEST['id']);
    $result = $f->getByID($f);
    echo json_encode(['result' => $result]);
}


if ($_REQUEST['acao'] == 'listarCombo') {
    $f = new Fornecedor();
    $result = $f->listarCombo();
    if ($result) {
        $html = "<option value='0'>Escolher...</option>";
        foreach ($result as $value) {
            $html .= "<option value='" . $value['id'] . "'>" . $value['razao_social'] . "</option>";
        }
    }
    echo json_encode(['html' => $html]);
}

if ($_REQUEST['acao'] == 'delete') {
    $f = new Fornecedor();
    $f->setId($_REQUEST['id']);
    $result = $f->delete($f);
    echo json_encode(['result' => $result]);
}