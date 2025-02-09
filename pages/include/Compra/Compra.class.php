<?php

require_once '../Conexao.php';

class Compra
{
    // Propriedades privadas para corresponder aos campos da tabela
    private $idCompra;
    private $funcionario;
    private $fornecedor;
    private $dtCompra;
    private $valorFinal;

    // Getters
    public function getIdCompra()
    {
        return $this->idCompra;
    }

    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;
    }

    public function getFuncionario()
    {
        return $this->funcionario;
    }

    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    public function getDtCompra()
    {
        return $this->dtCompra;
    }

    public function getValorFinal()
    {
        return $this->valorFinal;
    }

    // Setters
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    public function setDtCompra($dtCompra)
    {
        $this->dtCompra = $dtCompra;
    }

    public function setValorFinal($valorFinal)
    {
        $this->valorFinal = $valorFinal;
    }

    public function comprasUltimoMes()
    {
        try {
            $sql = "SELECT Compras.*, F.razao_social as fornecedor, F2.nome as funcionario
            FROM Compras
            LEFT JOIN Fornecedores F on Compras.idfornecedor = F.id
            left join Funcionarios F2 on F2.registro = Compras.idfuncionario
            WHERE dtCompra >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
            $preparado = Conexao::getPreparedStatement($sql);
            if ($preparado->execute()) {
                $result['lista'] = $preparado->fetchAll(PDO::FETCH_ASSOC);
                $sql = 'SELECT SUM(valorFinal) as total FROM Compras WHERE dtCompra >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);';
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

    public function inserir(Compra $compra)
    {
        $sql = 'INSERT INTO Compras (idfornecedor, idfuncionario, dtCompra, valorFinal) VALUES (?, ?, ?, ?);';
        $preparado = Conexao::getPreparedStatement($sql);
        $preparado->bindValue(1, $compra->getFornecedor());
        $preparado->bindValue(2, $compra->getFuncionario());
        $preparado->bindValue(3, $compra->getDtCompra());
        $preparado->bindValue(4, 0);
        if ($preparado->execute()) {
            $id = Conexao::getConexao()->lastInsertId();
            return ['sucesso' => true, 'lastId' =>$id];
        }
        return ['sucesso' => false];
    }
    public function listar()
    {
        try {
            $sql = "SELECT Compras.*, F.razao_social as fornecedor, F2.nome as funcionario
            FROM Compras
            LEFT JOIN Fornecedores F on Compras.idfornecedor = F.id
            LEFT JOIN Funcionarios F2 on F2.registro = Compras.idfuncionario;";
            $preparado = Conexao::getPreparedStatement($sql);
            if ($preparado->execute()) {
                return $preparado->fetchAll(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function listarItensCompra($idcompra)
    {
        try {
            $sql = "SELECT * FROM Compras 
            LEFT JOIN Itenscompra on Compras.idCompra = itenscompra.idCompra 
            LEFT JOIN Produtos on itenscompra.idProduto = produtos.id 
            WHERE Compras.idCompra = ?;";
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $idcompra);
            if ($preparado->execute()) {
                return $preparado->fetchAll(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


}