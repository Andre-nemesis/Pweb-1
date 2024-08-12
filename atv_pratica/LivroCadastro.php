<?php include_once 'LivroController.php';?>
    
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <title>Cadastro de Livro</title>
        <style>
            body {
                font-family: Arial;
            }
            .container {
                width: 300px;
                margin: 50px auto;
            }
            form {
                display: flex;
                flex-direction: column;
            }
            input[type="submit"] {
                margin-top: 10px;
                padding: 10px;
                background-color: #007BFF;
                color: white;
                border: none;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #0056b3;
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
            <h1>Cadastro de Livro</h1>
    
            <?php if (isset($mensagem)) : ?>
                <div class="mensagem"><?php echo $mensagem; ?></div>
            <?php endif; ?>
    
            <form method="post">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
    
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required>
    
                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" required>
    
                <input type="submit" value="Cadastrar">
            </form>
    
            <?php if ($livro_recuperado) : ?>
                <div class="livro-detalhes">
                    <h2>Livro Cadastrado:</h2>
                    <p><strong>Título:</strong> <?php echo $livro_recuperado->getTitulo(); ?></p>
                    <p><strong>Autor:</strong> <?php echo $livro_recuperado->getAutor(); ?></p>
                    <p><strong>Ano:</strong> <?php echo $livro_recuperado->getAno(); ?></p>
                </div>
            <?php endif; ?>

        </div>
        
    </body>
    </html>