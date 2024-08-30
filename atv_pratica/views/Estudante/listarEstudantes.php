<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../Controller/EstudanteController.php';
use Controller\EstudanteController;

$controller = new EstudanteController();
$estudantes = $controller->ListarEstudantes();
echo is_null($estudantes);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudantes</title>
    <?php include '../Head_Footer/menu.php'; ?>
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
            if (confirm("Tem certeza que deseja excluir este estudante?")) {
                window.location.href = 'excluirEstudante.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h1 style="margin-top: 5rem;">Lista de Estudantes</h1>
    <table>
        <tr> 
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php
        if (!empty($estudantes)) {
            foreach ($estudantes as $estudante) {
                echo "<tr>
                    <td>" . $estudante->getEstudanteId() . "</td>
                    <td>" . $estudante->getNome() . "</td>
                    <td>
                        <a href='editarEstudante.php?id=" . $estudante->getEstudanteId() . "'>Editar</a>
                        <button onclick='confirmarExclusao(" . $estudante->getEstudanteId() . ")'>Excluir</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum estudante encontrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>
