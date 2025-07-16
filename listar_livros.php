<?php
require_once 'classes/Database.php';

// Criação da conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Função para listar os livros
function listarLivros($conn, $pesquisa = null)
{
    try {
        // Se há pesquisa, filtra pelos dados
        if ($pesquisa) {
            $query = "SELECT * FROM livros WHERE titulo LIKE :pesquisa OR autor LIKE :pesquisa OR ano_publicacao LIKE :pesquisa";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':pesquisa', "%$pesquisa%", PDO::PARAM_STR);
        } else {
            $query = "SELECT * FROM livros";
            $stmt = $conn->prepare($query);
        }
        $stmt->execute();

        // Verifica se há registros no banco de dados
        if ($stmt->rowCount() > 0) {
            // Retorna todos os livros encontrados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    } catch (PDOException $e) {
        echo "Erro ao listar livros: " . $e->getMessage();
        return [];
    }
}

// Verifica se há pesquisa
$pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';
$livros = listarLivros($conn, $pesquisa);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Livros - Sistema de Biblioteca</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h1>Alma de Papel Livraria</h1>
                </div>
                <div class="col-auto">
                    <form class="form-inline" method="POST" action="">
                        <input class="form-control mr-sm-2" type="search" name="pesquisa" placeholder="Pesquisar Livro" value="<?= htmlspecialchars($pesquisa) ?>">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-5">
        <h2>Lista de Livros</h2>
        <?php if (count($livros) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano de Publicação</th>
                        <th>Disponível</th>
                        <th>Data de Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($livro['id']); ?></td>
                            <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                            <td><?php echo htmlspecialchars($livro['ano_publicacao']); ?></td>
                            <td><?php echo htmlspecialchars($livro['disponivel'] ? 'Sim' : 'Não'); ?></td>
                            <td><?php echo htmlspecialchars($livro['data_cadastro']); ?></td>
                            <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="excluir_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">Excluir</a>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Nenhum livro encontrado.</div>
        <?php endif; ?>
    </div>
</body>
</html>
