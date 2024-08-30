<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../../Controller/BibliotecaController.php';
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
    <?php include '../Head_Footer/menu.php'; ?>
    <style>
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
</head>
<body>
    <table style="margin-top: 5rem;">
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
