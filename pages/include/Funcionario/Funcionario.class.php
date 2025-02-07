<?php

require_once '../Conexao.php';

class Funcionario
{

    private $registro;
    private $nome;
    private $cargo;
    private $cpf;
    private $telefone;
    private $email;

    public function getRegistro()
    {
        return $this->registro;
    }

    public function setRegistro($registro)
    {
        $this->registro = $registro;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function inserir(Funcionario $obj)
    {
        try {
            $sql = 'INSERT INTO funcionarios (nome, cargo, cpf, telefone, email) VALUES (?, ?, ?, ?, ?);';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $obj->getNome());
            $preparado->bindValue(2, $obj->getCargo());
            $preparado->bindValue(3, $obj->getCpf());            
            $preparado->bindValue(4, $obj->getTelefone());
            $preparado->bindValue(5, $obj->getEmail());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Funcionario $obj)
    {
        try {
            $sql = 'UPDATE funcionarios SET nome = ?, cargo = ?, cpf = ?, telefone = ?, email = ? WHERE registro = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $obj->getNome());
            $preparado->bindValue(2, $obj->getCargo());
            $preparado->bindValue(3, $obj->getCpf());
            $preparado->bindValue(4, $obj->getTelefone());
            $preparado->bindValue(5, $obj->getEmail());
            $preparado->bindValue(6, $obj->getRegistro());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getByID(Funcionario $obj)
    {
        try {
            $sql = 'select * from funcionarios where registro = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $obj->getRegistro());
            if ($preparado->execute()) {
                return $preparado->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Funcionario $obj)
    {
        try {
            $sql = 'delete from funcionarios where registro = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $obj->getRegistro());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function listarCombo()
    {
        try {
            $sql = 'select registro, nome from funcionarios;';
            $preparado = Conexao::getPreparedStatement($sql);
            if ($preparado->execute()) {
                return $preparado->fetchAll(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function listar()
    {
        try {
            $sql = 'select * from funcionarios;';
            $preparado = Conexao::getPreparedStatement($sql);
            if ($preparado->execute()) {
                return $preparado->fetchAll(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>