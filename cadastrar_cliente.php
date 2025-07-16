<?php
require_once 'classes/Cliente.php';
require_once 'classes/Database.php';

// Criação da conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    // Criação de um novo cliente
    $cliente = new Cliente($nome, $email, $cpf, $telefone, $conn);

    // Salva o cliente no banco de dados, passando a conexão $conn
    if ($cliente->salvar($conn)) {
        echo "<div class='alert alert-success'>Cliente cadastrado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao cadastrar o cliente.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="org">
                <div class="logo">
                    <img src="img/livro.webp" alt="">
                </div>
                <div class="logo">
                    <h1> Alma de Papel Livraria</h1>
                </div>
            </div>

            <div class="search-bar">
                <input type="text" placeholder="Pesquisar...">
                <button type="button">Buscar</button>
            </div>
        </div>
    </header>
<div class="container mt-5">
    <h1>Cadastrar Cliente</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>
