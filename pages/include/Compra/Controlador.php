<?php
require_once 'Compra.class.php';
require_once 'ItensCompra.class.php';

if ($_REQUEST['acao'] === 'listarComprasUltimoMes') {
    $c = new Compra();
    $result = $c->comprasUltimoMes();

    if (!is_null($result)) {
        $html = '<table>
        <thead>
            <td>Compra</td>
            <td>Funcionario</td>
            <td>Fornecedor</td>
            <td>Data</td>
            <td>Valor Total</td>
        </thead>
        <tbody>';

        foreach ($result['lista'] as $compra) {
            $html .= '<tr>';
            $html .= '<td>' . $compra['idCompra'] . '</td>';
            $html .= '<td>' . $compra['funcionario'] . '</td>';
            $html .= '<td>' . $compra['fornecedor'] . '</td>';
            $html .= '<td>' . date('d/m/Y', strtotime($compra['dtCompra'])) . '</td>';
            $html .= '<td> R$ ' . $compra['valorFinal'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '<tfoot>';
        $html .= '<td colspan="4">Total</td>';
        $html .= '<td> R$ ' . $result['total']['total'] . '</td>';
        $html .= '</tfoot>';
        $html .= '</table>';
        echo json_encode(['html' => $html, 'dados' => $result]);
    } else {
        echo json_encode(['dados' => null]);
    }
}

if ($_REQUEST['acao'] === 'inserir') {
    $dados = json_decode(file_get_contents('php://input'), true);
    $c = new Compra();
    $c->setDtCompra($dados['dt_compra']);
    $c->setFuncionario($dados['funcionario']);
    $c->setFornecedor($dados['fornecedor']);
    $result = $c->inserir($c);
    echo json_encode(['result' => $result]);

}

if ($_REQUEST['acao'] === 'listar') {
    $c = new Compra();
    $result = $c->listar();
    if ($result) {
        $html = "<table>
        <thead>
            <tr>
                <th>Compra</th>
                <th>Funcionario</th>
                <th>Fornecedor</th>
                <th>Data</th>
                <th>Valor Total</th>
                <th>Produtos da compra</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($result as $value) {
            $html .= "<tr>
                        <td>" . $value['idCompra'] . "</td>
                        <td>" . $value['funcionario'] . "</td>
                        <td>" . $value['fornecedor'] . "</td>
                        <td>" . date('d/m/Y', strtotime($value['dtCompra'])) . "</td>
                        <td> R$ " . $value['valorFinal'] . "</td>
                        <td>
                            <button id='editar' onclick='verItensCompra(" . $value['idCompra'] . ")'><img src='../midia/icons/eye-solid.svg' height='20px'></button>                            
                        </td>
                    </tr>";
        }
        $html .= "</tbody></table>";
        echo json_encode(['html' => $html]);
    }
}


if ($_REQUEST['acao'] === 'inserirItensCompra') {
    $dados = json_decode(file_get_contents('php://input'), true);
    $ic = new ItensCompra();
    $ic->setIdCompra($dados['idCompra']);
    $ic->setIdProduto($dados['idProduto']);
    $ic->setQtd($dados['qtd']);
    $result = $ic->inserirItensCompra($ic);
    echo json_encode(['result'=> $result]);
}

if ($_REQUEST['acao'] === 'listarItensCompra') {
    $c = new Compra();
    $result = $c->listarItensCompra($_REQUEST['idCompra']);
    if ($result) {
        $html = "<table>
        <thead>
            <tr>
                <th>Compra</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($result as $value) {
            $html .= "<tr>
                        <td>" . $value['idCompra'] . "</td>
                        <td>" . $value['nome'] . "</td>
                        <td>" . $value['qtd'] . "</td>
                        <td> R$ " . $value['precoCusto'] . "</td>
                        <td> R$ " . $value['valorTotal'] . "</td>
                    </tr>";
        }
        $html .= "</tbody></table>";
        echo json_encode(['html' => $html]);
    }
}