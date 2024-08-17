<?php 
namespace Repository;

require_once '../Model/Biblioteca.php';
require_once '../db/DBConnectionHandler.php';
require_once '../Repository/EstudanteRepository.php';
require_once '../Repository/LivroRepository.php';
require_once '../Model/Relatorio.php';

use DateTime;
use Model\Biblioteca;
use db\DBConectionHandler;
use Exception;
use Repository\EstudanteRepository;
use Repository\LivroRepository;
use Model\Relatorio;


class BibliotecaRepository{
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
            if(mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
    }

    public function gerarRelatorio(){
        $this->openConnection();
        $query = 'CALL gerar_relatorio();';
        $relatorio = [];
        try{
            $result = $this->conn->query($query);
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $relatorio[] = new Relatorio($row['nome_estudante'],
                                                $row['titulo'],
                                                $row['data_inicio'],
                                                $row['data_fim']);
            }
            $result->free();
            return $relatorio;
            }
    
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
}

?>