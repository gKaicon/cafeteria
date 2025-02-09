<?php

require_once '../Conexao.php';

class Fornecedor
{
    private $id;
    private $razaoSocial;
    private $cnpj;
    private $logradouro;
    private $num;
    private $bairro;
    private $cidade;
    private $complemento;
    private $uf;
    private $cep;
    private $codigoMunicipio;
    private $telefone;
    private $email;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
    }

    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setNum($num)
    {
        $this->num = $num;
    }

    public function getNum()
    {
        return $this->num;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCodigoMunicipio($codigoMunicipio)
    {
        $this->codigoMunicipio = $codigoMunicipio;
    }

    public function getCodigoMunicipio()
    {
        return $this->codigoMunicipio;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function listarCombo()
    {
        try {
            $sql = 'select id, razao_social from Fornecedores where dt_delete is null;';
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
            $sql = 'select * from Fornecedores where dt_delete is null;';
            $preparado = Conexao::getPreparedStatement($sql);
            if ($preparado->execute()) {
                return $preparado->fetchAll(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function getByID(Fornecedor $obj)
    {
        try {
            $sql = 'select * from Fornecedores where id = ? and dt_delete is null;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $obj->getId());
            if ($preparado->execute()) {
                return $preparado->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Fornecedor $obj)
    {
        try {
            $sql = 'UPDATE Fornecedores SET dt_delete = NOW() where id = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $obj->getId());
            if ($preparado->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function inserir(Fornecedor $obj)
    {
        try {
            $sql = 'insert into Fornecedores (razao_social, cnpj, telefone, email, logradouro, num, bairro, cidade, complemento, uf, cep, codigoMunicipio) values (?,?,?,?,?,?,?,?,?,?,?,?);';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $obj->getRazaoSocial());
            $preparado->bindValue(2, $obj->getCnpj());
            $preparado->bindValue(3, $obj->getTelefone());
            $preparado->bindValue(4, $obj->getEmail());
            $preparado->bindValue(5, $obj->getLogradouro());
            $preparado->bindValue(6, $obj->getNum());
            $preparado->bindValue(7, $obj->getBairro());
            $preparado->bindValue(8, $obj->getCidade());
            $preparado->bindValue(9, $obj->getComplemento());
            $preparado->bindValue(10, $obj->getUf());
            $preparado->bindValue(11, $obj->getCep());
            $preparado->bindValue(12, $obj->getCodigoMunicipio());
            if ($preparado->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Fornecedor $obj) {
        try {
            $sql = 'UPDATE Fornecedores SET razao_social = ?, telefone = ?, email = ?, logradouro = ?, num = ?, bairro = ?, cidade = ?, complemento = ?, uf = ?, cep = ?, codigoMunicipio = ? WHERE id = ?;';
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $obj->getRazaoSocial());
            $preparado->bindValue(2, $obj->getTelefone());            
            $preparado->bindValue(3, $obj->getEmail());            
            $preparado->bindValue(4, $obj->getLogradouro());            
            $preparado->bindValue(5, $obj->getNum());            
            $preparado->bindValue(6, $obj->getBairro());            
            $preparado->bindValue(7, $obj->getCidade());            
            $preparado->bindValue(8, $obj->getComplemento());            
            $preparado->bindValue(9, $obj->getUf());            
            $preparado->bindValue(10, $obj->getCep());            
            $preparado->bindValue(11, $obj->getCodigoMunicipio());            
            $preparado->bindValue(12, $obj->getId());     
                   
            if ($preparado->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}