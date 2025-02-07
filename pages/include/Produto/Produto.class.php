<?php
require_once '../Conexao.php';

class Produto
{

    private $id;
    private $nome;
    private $descr;
    private $precoCusto;
    private $precoVenda;
    private $listavel;
    private $nomeImg;
    private $fornecedor;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setDescr($descr)
    {
        $this->descr = $descr;
    }

    public function getDescr()
    {
        return $this->descr;
    }

    public function setPrecoCusto($precoCusto)
    {
        $this->precoCusto = $precoCusto;
    }

    public function getPrecoCusto()
    {
        return $this->precoCusto;
    }

    public function setPrecoVenda($precoVenda)
    {
        $this->precoVenda = $precoVenda;
    }

    public function getPrecoVenda()
    {
        return $this->precoVenda;
    }

    public function setListavel($listavel)
    {
        $this->listavel = $listavel;
    }

    public function getListavel()
    {
        return $this->listavel;
    }

    public function setNomeImg($nomeImg)
    {
        $this->nomeImg = $nomeImg;
    }

    public function getNomeImg()
    {
        return $this->nomeImg;
    }

    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    public function inserir(Produto $p)
    {
        try {
            $sql = 'insert into produtos (nome, descr, precoCusto, precoVenda, listavel, nomeImg, idfornecedor) values (?,?,?,?,?,?,?);';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $p->getNome());
            $preparado->bindValue(2, $p->getDescr());
            $preparado->bindValue(3, $p->getPrecoCusto());
            $preparado->bindValue(4, $p->getPrecoVenda());
            $preparado->bindValue(5, $p->getListavel());
            $preparado->bindValue(6, $p->getNomeImg());
            $preparado->bindValue(7, $p->getFornecedor());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Produto $p)
    {
        try {
            $sql = 'UPDATE produtos SET nome = ?, descr = ?, precoCusto = ?, precoVenda = ?, listavel = ?, nomeImg = ?, idfornecedor = ? WHERE id = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $p->getNome());
            $preparado->bindValue(2, $p->getDescr());
            $preparado->bindValue(3, $p->getPrecoCusto());
            $preparado->bindValue(4, $p->getPrecoVenda());
            $preparado->bindValue(5, $p->getListavel());
            $preparado->bindValue(6, $p->getNomeImg());
            $preparado->bindValue(7, $p->getFornecedor());
            $preparado->bindValue(8, $p->getId());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteIMG(Produto $p)
    {
        try {
            $sql = 'UPDATE produtos SET nomeImg = NULL WHERE id = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $p->getId());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function listar(Produto $p)
    {
        try {
            $sql = 'SELECT produtos.*, fornecedores.razao_social as fornecedor FROM produtos LEFT JOIN fornecedores on fornecedores.id = produtos.idfornecedor;';
            $preparado = Conexao::getPreparedStatement($sql);
            if ($preparado->execute()) {
                return $preparado->fetchAll(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Produto $p)
    {
        try {
            $sql = 'delete from produtos where id = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $p->getId());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function listarParaPreencher()
    {
        $sql = 'select * from produtos where listavel = \'1\';';
        $preparado = Conexao::getPreparedStatement($sql);
        if ($preparado->execute())
            return $preparado->fetchAll(PDO::FETCH_ASSOC);
        return null;
    }
}