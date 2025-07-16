<?php
class Livro {
    private $id;
    private $titulo;
    private $autor; 
    private $ano_publicacao;
    private $disponivel;
    private $data_cadastro;

    // Construtor
    public function __construct($titulo, $autor, $ano_publicacao, $disponivel = true) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano_publicacao = $ano_publicacao;
        $this->disponivel = $disponivel;
        $this->data_cadastro = date('Y-m-d H:i:s'); // Data atual
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getAnoPublicacao() {
        return $this->ano_publicacao;
    }

    public function isDisponivel() {
        return $this->disponivel;
    }

    public function getDataCadastro() {
        return $this->data_cadastro;
    }

    // Método para marcar livro como não disponível
    public function marcarIndisponivel() {
        $this->disponivel = false;
    }

    // Método para marcar livro como disponível
    public function marcarDisponivel() {
        $this->disponivel = true;
    }

    // Outros métodos de validação podem ser adicionados...
}
?>





