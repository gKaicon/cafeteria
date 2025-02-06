<?php 
require_once '../Conexao.php';

class Produto {
    private $id;
    private $descr;
    private $precoCusto;
    private $nomeImg;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescr() {
        return $this->descr;
    }

    public function setDescr($descr) {
        $this->descr = $descr;
    }

    public function getPrecoCusto() {
        return $this->precoCusto;
    }

    public function setPrecoCusto($precoCusto) {
        $this->precoCusto = $precoCusto;
    }

    public function getNomeImg() {
        return $this->nomeImg;
    }

    public function setNomeImg($nomeImg) {
        $this->nomeImg = $nomeImg;
    }
    public function listarParaPreencher() {
        $sql = 'select * from produtos where listavel = \'1\';';
        $preparado = Conexao::getPreparedStatement($sql);
        if ($preparado->execute())
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        return null;
    }
}