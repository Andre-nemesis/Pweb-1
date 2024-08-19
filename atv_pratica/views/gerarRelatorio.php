<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Controller/BibliotecaController.php';
use Controller\BibliotecaController;

$controller = new BibliotecaController();
$relatorios = $controller->gerarRelatorio();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Emprestimo</title>
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
</head>
<body>
    <h1>Lista de Emprestimos</h1>
    <a href="index.php">Voltar para a página inicial</a>
    <table>
        <tr>
            <th>Livro</th>
            <th>Estudante</th>
            <th>Data Emprestimo</th>
            <th>Data Devolucao</th>
        </tr>
        <?php
        if (!empty($relatorios)) {
            foreach ($relatorios as $relatorio) {
                echo "<tr>
                    <td>" . $relatorio->getTituloLivro() . "</td>
                    <td>" . $relatorio->getNomeEstudante() . "</td>
                    <td>" . $relatorio->getDataEmprestimo() . "</td>
                    <td>" . $relatorio->getDataDevolucao() . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum registro encontrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>
