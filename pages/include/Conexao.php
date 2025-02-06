<?php
class Conexao
{
    private static $dsn = 'mysql:host=localhost;port=3306;dbname=trabalho';
    private static $user = 'root';
    private static $pwd = 'root';
    private static $conexao = null;

    public function __construct(){}

    public static function conecta()    {
        try {
            if (is_null(Conexao::$conexao))
                Conexao::$conexao = new PDO(Conexao::$dsn, Conexao::$user, Conexao::$pwd);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getConexao()    {
        Conexao::conecta();
        return Conexao::$conexao;
    }

    public static function getPreparedStatement($sql)    {
        Conexao::conecta();
        try {
            return Conexao::$conexao->prepare($sql);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
