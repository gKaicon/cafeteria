<?php
require_once 'Gasto.class.php';

if ($_REQUEST['acao'] === 'listarGastosUltimoMes') {
    $g = new Gasto();
    $result = $g->gastosUltimoMes();
    if (!is_null($result)) {
        $html = '<table>
                <thead>
                    <td>Descrição</td>
                    <td>Data</td>
                    <td>Valor</td>
                    <td>Ações</td>
                </thead>
                <tbody>';

        foreach ($result['lista'] as $gasto) {
            $cod = $gasto['id'];
            $html .= '<tr>';
            $html .= '<td>' . $gasto['descr'] . '</td>';
            $html .= '<td>' . date('d/m/Y', strtotime($gasto['dt_gasto'])) . '</td>';
            $html .= '<td> R$ ' . $gasto['valor_gasto'] . '</td>';
            $html .= "<td>
                            <button id='editar' onclick='editar($cod)'><img src='../midia/icons/pencil-solid.svg' height='20px'></button>
                            <button id='excluir' onclick='deletar($cod)'><img src='../midia/icons/trash-solid.svg' height='20px'></button>
                        </td>";
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '<tfoot>';
        $html .= '<td colspan="3">Total</td>';
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
    $g = new Gasto();
    $g->setId($_REQUEST['id']);
    $g->setDescr($dados['descr']);
    $g->setDtGasto($dados['dt_gasto']);
    $g->setValorGasto($dados['valor_gasto']);
    $result = $g->inserir($g);
}

if ($_REQUEST['acao'] === 'update') {
    $dados = json_decode(file_get_contents('php://input'), true);
    $g = new Gasto();
    $g->setId($_REQUEST['id']);
    $g->setDescr($dados['descr']);
    $g->setDtGasto($dados['dt_gasto']);
    $g->setValorGasto($dados['valor_gasto']);
    $result = $g->update($g);
}

if ($_REQUEST['acao'] === 'delete') {
    $g = new Gasto();
    $g->setId($_REQUEST['id']);
    $result = $g->deletar($g);
}