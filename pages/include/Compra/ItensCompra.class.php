<?php

require_once '../Conexao.php';

class ItensCompra {
    private $id;
    private $idCompra;
    private $idProduto;
    private $qtd;
    private $valorUnitario;
    private $valorTotal;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdCompra() {
        return $this->idCompra;
    }

    public function setIdCompra($idCompra) {
        $this->idCompra = $idCompra;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function getQtd() {
        return $this->qtd;
    }

    public function setQtd($qtd) {
        $this->qtd = $qtd;
    }

    public function getValorUnitario() {
        return $this->valorUnitario;
    }

    public function setValorUnitario($valorUnitario) {
        $this->valorUnitario = $valorUnitario;
    }

    public function getValorTotal() {
        return $this->valorTotal;
    }

    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }
}