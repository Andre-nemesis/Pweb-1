<?php
namespace Controller;

use Repository\AutorRepository;

require_once './atv_pratica/Repository/AutorRespository.php';

class AutorController {
    private AutorRepository $autorRepository;
    public function __construct() {
        // Lógica de inicialização, como conexão com banco de dados, etc.
        $this->autorRepository = new AutorRepository();
    }

    public function processarRequisicao() {
        // Verifica o método da requisição (POST, GET, etc.)
        $metodo = $_SERVER['REQUEST_METHOD'];

        // Verifica a ação a ser realizada (ex: cadastrar, listar, editar)
        $acao = isset($_GET['acao']) ? $_GET['acao'] : 'index';

        // Chama o método correspondente à ação
        $metodoCompleto = $metodo . $acao;
        if (method_exists($this, $metodoCompleto)) {
            $this->$metodoCompleto();
        } else {
            // Tratar requisições inválidas
            echo "Ação não encontrada";
        }
    }

    // Métodos para cada ação e método HTTP
    public function getPostCadastrar() {
        // Processa a requisição POST para cadastrar um registro
        $nome = $_POST['nome'];
        $nasc = $_POST['nacionalidade'];
    
        // Cria um novo objeto Autor Reposiotry
        $this->autorRepository->cadastrarAutor($nome,$nasc);
    
        // Mensagem de sucesso
        $mensagem = "autor cadastrado com sucesso!";
    }

    public function getPostDeletar(){
        // Captura os dados do formulário
        $nome = $_POST['nome'];

        // Cria um novo objeto Autor Reposiotry
        $this->autorRepository->deletarAutor($nome);

        // Mensagem de sucesso
        $mensagem = "autor deletado com sucesso!";
    }

    public function getGetlist(){
        // Cria um novo objeto Autor Reposiotry
        $this->autorRepository->listar_autores();
    }

    public function getPatchAtualizarAutor(){
        // Processa a requisição POST para cadastrar um registro
        $nome = $_POST['nome'];
        $nasc = $_POST['nacionalidade'];
    
        // Cria um novo objeto Autor Reposiotry
        $this->autorRepository->editarAutor($nome,$nasc);
    
        // Mensagem de sucesso
        $mensagem = "autor editado com sucesso!";
    }

}

$controlador = new AutorController();
$controlador->processarRequisicao();

?>