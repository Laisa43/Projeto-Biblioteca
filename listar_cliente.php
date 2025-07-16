<?php
require_once 'classes/database.php';

// Criação da conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Função para listar os clientes
function listar_cliente($conn) {
    try {
        // Query para buscar todos os clientes cadastrados
        $query = "SELECT * FROM clientes";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Verifica se há registros no banco de dados
        if ($stmt->rowCount() > 0) {
            // Retorna todos os clientes encontrados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    } catch (PDOException $e) {
        echo "Erro ao listar clientes: " . $e->getMessage();
        return [];
    }
}

// Chama a função para listar os clientes
$clientes = listar_cliente($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Cliente</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Lista de Clientes</h1>
    <?php if (count($clientes) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['id']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['data_cadastro']); ?></td>
                        <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="excluir_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">Excluir</a>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Nenhum cliente cadastrado.</div>
    <?php endif; ?>
</div>
</body>
</html>
