<?php
require_once 'Compra.class.php';

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



if ($_REQUEST['acao'] === '') {

}