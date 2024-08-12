<?php include_once 'LivroController.php';?>
    
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <title>Atividade prática</title>
        <style>
            body {
                font-family: Arial;
            }
            .container {
                width: 300px;
                margin: 50px auto;
            }
            .butons {
                display: flex;
                flex-direction: column;
            }
            .butons button{
                margin-top: 10px;
                padding: 10px;
                background-color: #007BFF;
                color: white;
                border: none;
                cursor: pointer;
            }
            .butons button a{
                color: white;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Controle Biblioteca</h1>

            <div class="butons">
                <button><a href="views/AutorView.html">Gerenciar Autores</a></button>
                <button><a href="LivroCadastro.php">Gerenciar Livros</a></button>
            </div>

        </div>
        
    </body>
    </html>