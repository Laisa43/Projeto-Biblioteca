<?php
require_once 'classes/Cliente.php';

// Criar a conexão
$database = new Database();
$conn = $database->getConnection();

// Verificar se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar os dados do cliente
    $query = "SELECT * FROM clientes WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        echo "Cliente não encontrado.";
        exit;
    }
}

// Atualizar os dados do cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $query = "UPDATE clientes SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Cliente atualizado com sucesso!";
        header("Location: listar_cliente.php");
    } else {
        echo "Erro ao atualizar cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h1>Editar Cliente</h1>
    <form action="" method="post">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="listar_cliente.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>

</html>
