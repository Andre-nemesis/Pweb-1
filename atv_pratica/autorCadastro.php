<?php include_once 'AutorController.php';?>
    
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
            <h1>Cadastro de Autor</h1>
    
            <?php if (isset($mensagem)) : ?>
                <div class="mensagem"><?php echo $mensagem; ?></div>
            <?php endif; ?>
    
            <form method="post">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
    
                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" id="nacionalidade" name="nacionalidade" required>
    
                <input type="submit" value="Cadastrar">
            </form>
    
            <?php if ($autor_recuperado) : ?>
                <div class="livro-detalhes">
                    <h2>Autor Cadastrado:</h2>
                    <p><strong>Nome:</strong> <?php echo $autor_recuperado->getNome(); ?></p>
                    <p><strong>Nascionalidade:</strong> <?php echo $autor_recuperado->getNascionalidade(); ?></p>
                </div>
            <?php endif; ?>

        </div>
        
    </body>
    </html>