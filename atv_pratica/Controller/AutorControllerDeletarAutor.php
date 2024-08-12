<?php
namespace Controller;

session_start();

use Repository\AutorRepository;
include_once './atv_pratica/Repository/AutorRespository.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];

    // Cria um novo objeto Livro
    $autor = new AutorRepository();
    $autor->deletarAutor($nome);

    // Serializa e salva o objeto na sessão
    $_SESSION['autor'] = serialize($autor);

    // Mensagem de sucesso
    $mensagem = "autor cadastrado com sucesso!";
}


?>