<?php
class Cliente {
    private $id;
    private $nome;
    private $email;
    private $cpf;
    private $telefone;
    private $data_cadastro;

    // Construtor
    public function __construct($nome, $email, $cpf, $telefone) {
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->data_cadastro = date('Y-m-d H:i:s');
    }

    // Método para salvar cliente no banco de dados
    public function salvar($conn) {
        try {
            // Query de inserção
            $query = "INSERT INTO clientes (nome, email, cpf, telefone, data_cadastro)
                      VALUES (:nome, :email, :cpf, :telefone, :data_cadastro)";
            $stmt = $conn->prepare($query); // Garantindo que a conexão é passada corretamente

            // Bind dos valores
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":data_cadastro", $this->data_cadastro);

            // Executa a query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao salvar cliente: " . $e->getMessage();
            return false;
        }
    }
}
?>
