<?php

require_once 'Funcionario.class.php';

if ($_REQUEST['acao'] === 'inserir') {
    $dados = json_decode(file_get_contents('php://input'), true);
    $fu = new Funcionario();
    $fu->setNome($dados['nome']);
    $fu->setTelefone($dados['telefone']);
    $fu->setEmail($dados['email']);
    $fu->setCargo($dados['cargo']);
    $fu->setCpf($dados['cpf']);
    $result = $fu->inserir($fu);
    
    echo json_encode(['result' => $result]);    
}


if ($_REQUEST['acao'] === 'update') {
    $dados = json_decode(file_get_contents('php://input'), true);
    $fu = new Funcionario();
    $fu->setRegistro($_REQUEST['id']);
    $fu->setNome($dados['nome']);
    $fu->setTelefone($dados['telefone']);
    $fu->setEmail($dados['email']);
    $fu->setCargo($dados['cargo']);
    $fu->setCpf($dados['cpf']);
    $result = $fu->update($fu);
    
    echo json_encode(['result' => $result]);   
}


if ($_REQUEST['acao'] === 'getByID') {
    $fu = new Funcionario();
    $fu->setRegistro($_REQUEST['id']);
    $result = $fu->getByID($fu);

    echo json_encode(['result' => $result]);   
}

if ($_REQUEST['acao'] === 'delete') {
    $fu = new Funcionario();
    $fu->setRegistro($_REQUEST['id']);
    $result = $fu->delete($fu);

    echo json_encode(['result' => $result]);    
}


if ($_REQUEST['acao'] === 'listar') {
    $fu = new Funcionario();
    $result = $fu->listar();
    if ($result) {
        $html = "<table>
        <thead>
            <tr>
                <th>Registro</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($result as $value) {
            $html .= "<tr>
                        <td>" . $value['registro'] . "</td>
                        <td>" . $value['nome'] . "</td>
                        <td>" . ucfirst($value['cargo']) . "</td>
                        <td>" . $value['cpf'] . "</td>
                        <td>" . $value['telefone'] . "</td>
                        <td>" . $value['email'] . "</td>
                        <td>
                            <button id='editar' onclick='editar(" . $value['registro'] . ")'><img src='../midia/icons/pencil-solid.svg' height='20px'></button>
                            <button id='excluir' onclick='excluir(" . $value['registro'] . ")'><img src='../midia/icons/trash-solid.svg' height='20px'></button>
                        </td>
                    </tr>";
        }
        $html .= "</tbody></table>";
    }
    echo json_encode(['html' => $html]);
    
}


if ($_REQUEST['acao'] === 'listarCombo') {

    $fu = new Funcionario();
    $result = $fu->listarCombo();
    if ($result) {
        $html = "";
        foreach ($result as $value) {
            $html .= "<option value='" . $value['id'] . "'>" . $value['nome'] . "</option>";
        }
    }
    echo json_encode(['html' => $html]);
    
}
