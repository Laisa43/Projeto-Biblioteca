# 📚 Alma de Papel Livraria

Este é um sistema simples de cadastro de clientes desenvolvido em PHP, com banco de dados MySQL, voltado para uma livraria fictícia chamada **Alma de Papel**. A aplicação permite o registro de informações básicas de clientes como nome, e-mail, CPF e telefone.

---

## 🚀 Funcionalidades

- Cadastro de clientes via formulário web
- Armazenamento seguro das informações no banco de dados
- Estilização com Bootstrap 4
- Organização do código com classes PHP orientadas a objetos

---

## 🛠️ Tecnologias Utilizadas

- PHP 7+
- MySQL
- HTML5
- CSS3
- Bootstrap 4
- Padrão de código orientado a objetos (OOP)

---

## 🧩 Estrutura de Arquivos

```
ProjetoBiblioteca/
│
├── index.php                # Página inicial ou principal
├── cadastro_cliente.php     # Página de cadastro de clientes (este arquivo)
├── classes/
│   ├── Cliente.php          # Classe responsável pela lógica do cliente
│   └── Database.php         # Classe de conexão com o banco de dados
├── style.css                # Estilizações personalizadas
├── img/
│   └── livro.webp           # Logotipo ou imagem da livraria
```

---

## 📝 Como Executar o Projeto

1. Clone este repositório ou extraia os arquivos no seu servidor local (ex: Laragon, XAMPP).
2. Crie o banco de dados no MySQL com a estrutura necessária (exemplo abaixo).
3. Ajuste os dados de conexão no arquivo `Database.php`.
4. Acesse `cadastro_cliente.php` pelo navegador e preencha o formulário.

---

## 🗄️ Exemplo de Estrutura de Banco de Dados

```sql
CREATE DATABASE biblioteca;

USE biblioteca;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    telefone VARCHAR(20) NOT NULL
);
```

---

## 👩‍💻 Autor(a)

**Laisa Lorrane**  
Projeto desenvolvido como parte do curso de Sistemas de Informação no IFNMG - Campus Porteirinha.

---


---

## 📄 Licença

Este projeto é livre para uso acadêmico e educativo.
