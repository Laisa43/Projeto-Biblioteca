<?php
// classes/Database.php

class Database {
    private $host = "localhost";
    private $db_name = "sistema_biblioteca"; // Substitua pelo nome do seu banco de dados
    private $username = "root"; // Usuário padrão do XAMPP
    private $password = "";     // Senha padrão do XAMPP (vazia)
    public $conn;

    // Método para obter a conexão
    public function getConnection(){
        $this->conn = null;

        try{
            // Configurações de DSN
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";
            // Cria a conexão
            $this->conn = new PDO($dsn, $this->username, $this->password);
            // Define o modo de erro do PDO para exceção
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception){
            echo "Erro na conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
