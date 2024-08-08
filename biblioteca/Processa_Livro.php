<?php

session_start();
include_once 'Livro.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];

    // Cria um novo objeto Livro
    $livro = new Livro($titulo, $ano, $autor);


    // Serializa e salva o objeto na sessão
    $_SESSION['livro'] = serialize($livro);

    // Mensagem de sucesso
    $mensagem = "Livro cadastrado com sucesso!";
}


// Recupera o livro da sessão, se existir
$livro_recuperado = isset($_SESSION['livro']) ? unserialize($_SESSION['livro']) : null;
?>