<html>
  <style>

    .formulario{
      display: none;
    }
  </style>
  <head>
    <title>Biblioteca</title>
  </head>
  <body>
  <form>
    <button id ="adicionar_autor" type="button">Adicionar Autor</button>

    <button id ="adicionar_livro" type="button">Adicionar Livro</button>

    <button id="adicionar_estudante" type = "button">Adicionar Estudante</button>

    <div id="form_autor" class="formulario">
        <h2>Adicionar Autor</h2>
        <form>
            <label for="nome_autor">Nome:</label>
            <input type="text" id="nome_autor" name="nome_autor">
          <label for="id_autor">Id do Autor:</label>
            <input type="text" id="id_autor" name="id_autor">
          <label for="nacionalidade"> Nacinalidade:</label>
          <input type="text" id = "nacionalidade" name="nacionalidade">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <div id="form_livro" class="formulario">
        <h2>Adicionar Livro</h2>
        <form>
            <label for="titulo_livro">Título:</label>
            <input type="text" id="titulo_livro" name="titulo_livro">
            <label for="autor_livro">Autor:</label>
            <input type="text" id="autor_livro" name="autor_livro">
            <label for="ano_livro">Ano:</label>
            <input type="text" id="ano_livro" name="ano_livro">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <div id="form_estudante" class="formulario">
        <h2>Adicionar Estudante</h2>
        <form>
            <label for="nome_estudante">Nome:</label>
            <input type="text" id="nome_estudante" name="nome_estudante">
            <label for="id_estudante">Id do Estudante:</label>
            <input for= "id_estudante" name="id_estudante">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <?php
    //escondendo os elementos ao clicar
  ?>
    <script>
        document.getElementById('adicionar_autor').addEventListener('click', function() {
            toggleForm('form_autor');
        });

        document.getElementById('adicionar_livro').addEventListener('click', function() {
            toggleForm('form_livro');
        });

        document.getElementById('adicionar_estudante').addEventListener('click', function() {
            toggleForm('form_estudante');
        });

        function toggleForm(formId) {
            const forms = document.querySelectorAll('.formulario');
            forms.forEach(form => {
                if (form.id === formId) {
                    form.style.display = (form.style.display === 'block') ? 'none' : 'block';
                } else {
                    form.style.display = 'none';
                }
            });
        }
    </script>
    
  </body>
</html>