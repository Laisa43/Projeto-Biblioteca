<?php
require_once 'classes/Cliente.php';

// Criar a conexão
$database = new Database();
$conn = $database->getConnection();

// Verificar se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o cliente
    $query = "DELETE FROM clientes WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Cliente excluído com sucesso!";
    } else {
        echo "Erro ao excluir cliente.";
    }
}

// Redirecionar para a lista de clientes
header("Location: listar_cliente.php");
exit;
?>
