<?php

require_once '../Conexao.php';

class Compra {
    // Propriedades privadas para corresponder aos campos da tabela
    private $idCompra;
    private $funcionario;
    private $fornecedor;
    private $dtCompra;
    private $valorFinal;

    // Getters
    public function getIdCompra() {
        return $this->idCompra;
    }

    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;
    }

    public function getFuncionario() {
        return $this->funcionario;
    }

    public function getFornecedor() {
        return $this->fornecedor;
    }

    public function getDtCompra() {
        return $this->dtCompra;
    }

    public function getValorFinal() {
        return $this->valorFinal;
    }

    // Setters
    public function setFuncionario($funcionario) {
        $this->funcionario = $funcionario;
    }

    public function setFornecedor($fornecedor) {
        $this->fornecedor = $fornecedor;
    }

    public function setDtCompra($dtCompra) {
        $this->dtCompra = $dtCompra;
    }

    public function setValorFinal($valorFinal) {
        $this->valorFinal = $valorFinal;
    }

    public function comprasUltimoMes(){
        $sql = "SELECT Compras.*, F.razao_social as fornecedor, F2.nome as funcionario
                FROM Compras
                LEFT JOIN Fornecedores F on Compras.idfornecedor = F.id
                left join Funcionarios F2 on F2.registro = Compras.idfuncionario
                WHERE dtCompra >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        $preparado = Conexao::getPreparedStatement($sql);
        if ($preparado->execute()){
            $result['lista'] = $preparado->fetchAll(PDO::FETCH_ASSOC);
            $sql = 'SELECT SUM(valorFinal) as total FROM Compras WHERE dtCompra >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);';
            $preparado = Conexao::getPreparedStatement($sql);
            if ($preparado->execute()){
                $result['total'] = $preparado->fetch(PDO::FETCH_ASSOC);
            }
            return $result;
        }
        return null;
    }
}