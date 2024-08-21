<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/LivroController.php';
use Controller\LivroController;

$controller = new LivroController();
$livros = $controller->ListarLivros();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros</title>
    <?php include 'menu.php'; ?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir este Livro?")) {
                window.location.href = 'excluirLivro.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h1>Lista de Livros</h1>
    <a href="index.php">Voltar para a página inicial</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Ano</th>
            <th>Status</th>
            <th>Id Autor</th>
            <th>Ações</th>
        </tr>
        <?php
        if (!empty($livros)) {
            foreach ($livros as $livro) {
                echo "<tr>
                    <td>" . $livro->getIdLivro() . "</td>
                    <td>" . $livro->getTitulo() . "</td>
                    <td>" . $livro->getAno() . "</td>
                    <td>" . $livro->getStatus() . "</td>
                    <td>" . $livro->getAutor() . "</td>
                    <td>
                        <a href='editarLivro.php?id=" . $livro->getIdLivro() . "'>Editar</a>
                        <button onclick='confirmarExclusao(" . $livro->getIdLivro() . ")'>Excluir</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum livro encontrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>
