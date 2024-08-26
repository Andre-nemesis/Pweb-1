<?php 
namespace Repository;

require_once '../db/DBConnectionHandler.php';
require_once '../Repository/EstudanteRepository.php';
require_once '../Repository/LivroRepository.php';
require_once '../Model/Relatorio.php';

use db\DBConectionHandler;
use Exception;
use Repository\EstudanteRepository;
use Repository\LivroRepository;
use Model\Relatorio;


class BibliotecaRepository{
    /**
     * Classe de BibliotecaRepository
     * Classe referente a gestão de da entrada de dados referente ao modelo Relatório.
     *
     * @author André Casimiro <andre.casimiro@gmail.com>
     * @author Geovanna <fgeovanna111@gmail.com>
     * @version 1.0
     */
    private EstudanteRepository $estudante_repo;
    private LivroRepository $livro_repo;
    private DBConectionHandler $connection_handle;
    private $conn;

    public function __construct(){
        $this->estudante_repo = new EstudanteRepository();
        $this->livro_repo = new LivroRepository();
    }

    public function openConnection(){
        $this->connection_handle = new DBConectionHandler();
        $this->conn = $this->connection_handle->getConnection();
    }

    public function emprestarLivro(string $nome_estudante, string $titulo_livro,string $data_emprestimo){
        $id_estudante = $this->estudante_repo->getEstudanteId($nome_estudante);
        $id_livro = $this->livro_repo->getLivroId($titulo_livro);
        $this->openConnection();
        $query = 'CALL emprestar_livro(?,?,?);';
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('iis',$id_estudante,$id_livro, $data_emprestimo);
            $stmt->execute();
            if($stmt->error){
                throw new Exception('Error on [emprestimo livro]:' . $stmt->error);
            }
            $stmt->close();
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            if(mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }

    }

    public function devolverLivro (string $titulo_livro, string $data_devolucao){
        $this->openConnection();
        $id_livro = $this->livro_repo->getLivroId($titulo_livro);
        $query = 'CALL devolver_livro(?,?);';
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('is',$id_livro,$data_devolucao);
            $stmt->execute();
            if($stmt->error){
                throw new Exception('Error on [devolução livro]:' . $stmt->error);
            }
            $stmt->close();
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
    }

    // Gera um relatório de livros reservados
    public function gerarRelatorio(){
        $this->openConnection();
        $query = 'CALL gerar_relatorio();';
        $relatorio = [];
        try{
            $result = $this->conn->query($query);
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    // Se a data do fim do empréstimo for nulla, adiciona uma nova instância de Relatorio ao array com "sem data"
                    if(is_null($row['data_fim'])){
                        $relatorio[] = new Relatorio($row['nome_estudante'],
                                                $row['titulo'],
                                                $row['data_inicio'],
                                                'sem data');
                    }
                    else{
                        // Se não, adiciona uma nova instância de Realtorio com a informação da data de fim do empréstimo
                        $relatorio[] = new Relatorio($row['nome_estudante'],
                                                $row['titulo'],
                                                $row['data_inicio'],
                                                $row['data_fim']);
                    }
                    
                }
            $result->free();
            return $relatorio;
            }
    
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->conn->close();
        }   
    }
}

?>
