<?php

require_once '../Conexao.php';

class Gasto
{
    // Propriedades privadas para corresponder aos campos da tabela
    private $id;
    private $descr;
    private $dtGasto;
    private $valorGasto;

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getDescr()
    {
        return $this->descr;
    }

    public function getDtGasto()
    {
        return $this->dtGasto;
    }

    public function getValorGasto()
    {
        return $this->valorGasto;
    }

    // Setters

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDescr($descr)
    {
        $this->descr = $descr;
    }

    public function setDtGasto($dtGasto)
    {
        $this->dtGasto = $dtGasto;
    }

    public function setValorGasto($valorGasto)
    {
        $this->valorGasto = $valorGasto;
    }

    public function gastosUltimoMes()
    {
        try {
            $sql = 'SELECT * FROM Gastos WHERE dt_gasto >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);';
            $preparado = Conexao::getPreparedStatement($sql);
            if ($preparado->execute()) {
                $result['lista'] = $preparado->fetchAll(PDO::FETCH_ASSOC);
                $sql = 'SELECT SUM(valor_gasto) as total FROM Gastos WHERE dt_gasto >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);';
                $preparado = Conexao::getPreparedStatement($sql);
                if ($preparado->execute()) {
                    $result['total'] = $preparado->fetch(PDO::FETCH_ASSOC);
                }
                return $result;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function inserir(Gasto $g)
    {
        $sql = 'INSERT INTO Gastos (descr, dt_gasto, valor_gasto) VALUES (?, ?, ?);';
        $preparado = Conexao::getPreparedStatement($sql);
        $preparado->bindValue(1, $g->getDescr());
        $preparado->bindValue(2, $g->getDtGasto());
        $preparado->bindValue(3, $g->getValorGasto());
        if ($preparado->execute()) {
            return true;
        }
        return false;

    }

    public function update(Gasto $g)
    {
        try {
            $sql = 'UPDATE Gastos SET descr = ?, dt_gasto = ?, valor_gasto = ? WHERE id = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $g->getDescr());
            $preparado->bindValue(2, $g->getDtGasto());
            $preparado->bindValue(3, $g->getValorGasto());
            $preparado->bindValue(4, $g->getId());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(Gasto $g)
    {
        try {
            $sql = 'DELETE FROM Gastos WHERE id = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $g->getId(), PDO::PARAM_INT);
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}