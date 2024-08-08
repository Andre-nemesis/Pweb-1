<?php include_once 'Processa_Livro.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <style>
            body {
                font-family: Arial;
            }
            .container {
                width: 300px;
                margin: 50px auto;
            }
            .mensagem {
                margin-top: 10px;
                color: green;
            }
            .livro-detalhes {
                margin-top: 20px;
            }
            button{
                margin-top: 10px;
                padding: 10px;
                background-color: #007BFF;
                color: white;
                border: none;
                cursor: pointer;
            }
            button a{
                color: white;
                text-decoration: none;
            }
        </style>
</head>
<body>
    <div class="container">
        <h1>Livros cadastrados</h1>
        <?php if ($livros_recuperado) : ?>
            <?php foreach ($livros_recuperado as $livro) :?>
                <div class="livro-detalhes">
                    <p><strong>Título: </strong> <?php echo $livro->getTitulo();?></p>
                    <p><strong>Ano: </strong> <?php echo $livro->getAno();?></p>
                    <p><strong>Autor: </strong> <?php echo $livro->getAutor();?></p>
                </div>
            <?php endforeach;?>
        <?php endif;?>
            
        <div>
            <button><a href="index.php">Cadastrar Livro</a></button>
        </div>
    </div>
</body>
</html>