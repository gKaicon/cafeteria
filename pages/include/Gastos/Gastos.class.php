<?php

require_once '../Conexao.php';

class Gasto {
    // Propriedades privadas para corresponder aos campos da tabela
    private $id;
    private $descr;
    private $dtGasto;
    private $valorGasto;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getDescr() {
        return $this->descr;
    }

    public function getDtGasto() {
        return $this->dtGasto;
    }

    public function getValorGasto() {
        return $this->valorGasto;
    }

    // Setters
    public function setDescr($descr) {
        $this->descr = $descr;
    }

    public function setDtGasto($dtGasto) {
        $this->dtGasto = $dtGasto;
    }

    public function setValorGasto($valorGasto) {
        $this->valorGasto = $valorGasto;
    }
}