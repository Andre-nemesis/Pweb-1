<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/EstudanteController.php';
use Controller\EstudanteController;

$controller = new EstudanteController();
$estudantes = $controller->ListarEstudantes();
echo is_null($estudantes);
/*
foreach ($estudantes as $estud){
    echo $estud->getNome() . ' ' . $estud->getEstudanteId() .'<br>';
}*/
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudantes</title>
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
            if (confirm("Tem certeza que deseja excluir este estudante?")) {
                window.location.href = 'excluirEstudante.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h1>Lista de Estudantes</h1>
    <a href="index.php">Voltar para a página inicial</a>
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
