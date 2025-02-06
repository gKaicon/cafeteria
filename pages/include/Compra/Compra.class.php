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
}