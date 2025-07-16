<?php
require_once 'Cliente.php';
require_once 'Livro.php';

class Biblioteca {
    private $conn;
    private $livros = [];
    private $clientes = [];

    // Construtor com dependência da conexão
    public function __construct($db){
        $this->conn = $db;
    }

    // Método para adicionar um livro à biblioteca
    public function cadastrar_livro(Livro $livro) {
        $this->livros[] = $livro;
        echo "O livro '{$livro->getTitulo()}' foi adicionado à biblioteca.<br>";
    }

    // Método para cadastrar um cliente na biblioteca
    public function cadastrarCliente(Cliente $cliente) {
        $this->clientes[] = $cliente;
        echo "Cliente '{$cliente->getNome()}' foi cadastrado na biblioteca.<br>";
    }

    // Método para listar os livros disponíveis na biblioteca
    public function listarLivrosDisponiveis() {
        $livrosDisponiveis = array_filter($this->livros, function($livro) {
            return $livro->isDisponivel();
        });

        if (count($livrosDisponiveis) > 0) {
            echo "Livros disponíveis na biblioteca:<br>";
            foreach ($livrosDisponiveis as $livro) {
                echo "- " . $livro->getTitulo() . " de " . $livro->getAutor() . "<br>";
            }
        } else {
            echo "Não há livros disponíveis no momento.<br>";
        }
    }

    // Método para listar todos os clientes cadastrados
    public function listarClientes() {
        if (count($this->clientes) > 0) {
            echo "Clientes cadastrados na biblioteca:<br>";
            foreach ($this->clientes as $cliente) {
                echo "- " . $cliente->getNome() . " (Email: " . $cliente->getEmail() . ")<br>";
            }
        } else {
            echo "Nenhum cliente cadastrado.<br>";
        }
    }

    // Outros métodos relacionados à gestão da biblioteca...
}
?>
