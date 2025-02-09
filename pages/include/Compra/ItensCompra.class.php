<?php

require_once '../Conexao.php';

class ItensCompra
{
    private $id;
    private $idCompra;
    private $idProduto;
    private $qtd;
    private $valorUnitario;
    private $valorTotal;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdCompra()
    {
        return $this->idCompra;
    }

    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;
    }

    public function getIdProduto()
    {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
    }

    public function getQtd()
    {
        return $this->qtd;
    }

    public function setQtd($qtd)
    {
        $this->qtd = $qtd;
    }

    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }

    public function setValorUnitario($valorUnitario)
    {
        $this->valorUnitario = $valorUnitario;
    }

    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;
    }

    public function inserirItensCompra(ItensCompra $itensCompra)
    {
        try {
            $sql = "SELECT * FROM Produtos WHERE id = ?;";
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $itensCompra->getIdProduto());
            if ($preparado->execute()) {
                $produto = $preparado->fetch(PDO::FETCH_ASSOC);
                $itensCompra->setValorUnitario($produto['precoCusto']);
                $itensCompra->setValorTotal($produto['precoCusto'] * $itensCompra->getQtd());
                $sql = "INSERT INTO Itenscompra (idCompra, idProduto, qtd, valorUnitario, valorTotal) VALUES (?, ?, ?, ?, ?);";
                $preparado = Conexao::getPreparedStatement($sql);
                $preparado->bindValue(1, $itensCompra->getIdCompra());
                $preparado->bindValue(2, $itensCompra->getIdProduto());
                $preparado->bindValue(3, $itensCompra->getQtd());
                $preparado->bindValue(4, $itensCompra->getValorUnitario());
                $preparado->bindValue(5, $itensCompra->getValorTotal());
                if ($preparado->execute()) {
                    $select = "SELECT sum(valorTotal) as valorFinal FROM Itenscompra WHERE idCompra = ?;";
                    $preparado = Conexao::getPreparedStatement($select);
                    $preparado->bindValue(1, $itensCompra->getIdCompra());
                    if ($preparado->execute()) {
                        $compra = $preparado->fetch(PDO::FETCH_ASSOC);
                        $total = $compra['valorFinal'];
                        $update = "UPDATE Compras SET valorFinal = ? WHERE idCompra = ?;";
                        $preparado = Conexao::getPreparedStatement($update);
                        $preparado->bindValue(1, $total);
                        $preparado->bindValue(2, $itensCompra->getIdCompra());
                        $preparado->execute();
                        return true;
                    }
                }
                return false;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}