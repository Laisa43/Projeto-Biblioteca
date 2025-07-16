<?php
require_once 'classes/database.php'; 
require_once 'classes/livro.php';
// require_once 'classes/cadastrar_livro.php';  // Certifique-se de que este arquivo também está correto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $titulo = $_POST['titulo'];  
    $autor = $_POST['autor'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $disponivel = $_POST['disponivel'] ? true : false; // Converte para booleano
    $data_cadastro = $_POST['data_cadastro'];

    // Instanciar o banco de dados e obter a conexão
    $database = new Database();
    $con = $database->getConnection();

    
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar um novo livro
    $livro = new livro($titulo, $autor, $ano_publicacao, $disponivel, $data_cadastro);

    // Query para inserir o livro no banco de dados
    $query = "INSERT INTO livros (titulo, autor, ano_publicacao, disponivel, data_cadastro)
              VALUES (:titulo, :autor, :ano_publicacao, :disponivel, :data_cadastro)";
    $stmt = $con->prepare($query);

    // Vincular os parâmetros diretamente do objeto Livro
    $tituloParam = $livro->getTitulo();
    $autorParam = $livro->getAutor();
    $anoPublicacaoParam = $livro->getAnoPublicacao();
    $disponivelParam = $livro->isDisponivel();
    $dataCadastroParam = $livro->getDataCadastro();
      
    // Vincular os parâmetros
    $stmt->bindParam(':titulo', $tituloParam);
    $stmt->bindParam(':autor', $autorParam);
    $stmt->bindParam(':ano_publicacao', $anoPublicacaoParam);
    $stmt->bindParam(':disponivel', $disponivelParam, PDO::PARAM_BOOL);
    $stmt->bindParam(':data_cadastro', $dataCadastroParam);

    // Executar a query e verificar se foi bem-sucedida
    try {
        if ($stmt->execute()) {
            echo "Livro cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar livro: A operação não foi bem-sucedida.";
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar livro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Cadastro de Livro</title>
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
        <h1>Cadastrar Livro</h1>
        <form action="" method="post">
            <div class="form-group">
                <label>Título:</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>

            <div class="form-group">
                <label>Autor:</label>
                <input type="text" class="form-control" name="autor" required>
            </div>

            <div class="form-group">
                <label>Ano de Publicação:</label>
                <input type="number" class="form-control" name="ano_publicacao" required>
            </div>

            <div class="form-group">
                <label>Disponível:</label>
                <select name="disponivel" class="form-control" required>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>

            <div class="form-group">
                <label>Data de Cadastro:</label>
                <input type="date" class="form-control" name="data_cadastro" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Livro</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>

</html>
