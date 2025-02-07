<?php

require_once '../Conexao.php';

class UserLogin
{

    private $username;

    private $pwd;

    private $email;

    private $tipoUsuario;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPwd()
    {
        return $this->pwd;
    }

    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;

        return $this;
    }

    public function verificaSenhaCorreta(UserLogin $u)
    {
        try {
            if ($this->verificaUsuarioExiste($u)) {
                $sql = "SELECT pwd FROM users WHERE username = ? or email = ?";
                $preparado = Conexao::getPreparedStatement($sql);
                $preparado->bindValue(1, $u->getUsername());
                $preparado->bindValue(2, $u->getEmail());
                var_dump($sql);
                if (!is_null($preparado->execute())) {
                    $pwdParaVerificar = $preparado->fetch();
                    if (password_verify($u->getPwd(), $pwdParaVerificar['pwd'])) {
                        return true;
                    }
                    return false;
                }
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function verificaUsuarioExiste(UserLogin $u)
    {
        try {
            $sql = "SELECT * FROM users WHERE username = ? or email = ?";
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $u->getUsername());
            $preparado->bindValue(2, $u->getEmail());
            if (!is_null($preparado->execute())) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function logar(UserLogin $u)
    {

        try {
            $sql = "SELECT * FROM users WHERE username = ? AND pwd = ?";
            $preparado = Conexao::getPreparedStatement($sql);
            $preparado->bindValue(1, $u->getUsername());
            $preparado->bindValue(2, $u->getPwd());
            if (!is_null($preparado->execute())) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
?>