<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/AutorController.php';
use Controller\AutorController;

$controller = new AutorController();
$autores = $controller->ListarAutores();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
    <?php include 'menu.php'; ?>
    <style>
        h1{
            color: #13072e;
        }
        a {
            margin-right: 10px;
            text-decoration: none;
            color: #13072e;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            background-color: #ff4b5c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #f41b30;
        }
    </style>
    <script>
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir este autor?")) {
                window.location.href = 'excluirAutor.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h1 style="margin-top: 5rem;">Lista de Autores</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Nacionalidade</th>
            <th>Ações</th>
        </tr>
        <?php
        // Verificar se o array de autores não está vazio
        if (!empty($autores)) {
            foreach ($autores as $autor) {
                // Mostra as infotmações do autor na tabela
                echo "<tr>
                    <td>" . $autor->getIdAutor() . "</td>
                    <td>" . $autor->getNome() . "</td>
                    <td>" . $autor->getNacionalidade() . "</td>
                    <td>
                        <a href='editarAutor.php?id=" . $autor->getIdAutor() . "'>Editar</a>
                        <button onclick='confirmarExclusao(" . $autor->getIdAutor() . ")'>Excluir</button>
                    </td>
                </tr>";
            }
        } else {
            // Se o array autores estiver vazio 
            echo "<tr><td colspan='4'>Nenhum autor encontrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>
