<?php 
namespace Repository;

use db\DBConectionHandler;
use Model\Livro;
use Exception;
use Repository\AutorRepository;

require_once './atv_pratica/Repository/AutorRespository.php';
require_once './atv_pratica/Model/Livro.php';
require_once './atv_pratica/db/DBConnectionHandler.php';

class LivroRepository{
    private Livro $livro;
    private DBConectionHandler $connection_handle;
    private $conn;

    public function __construct(){}

    public function openConnection(){
        $this->connection_handle = new DBConectionHandler();
        $this->conn = $this->connection_handle->getConnection();
    }

    public function cadastrarLivro(string $titulo, int $ano, int $id_autor){
        $this->livro = new Livro($titulo,$ano,$id_autor);
        try{
            $stmt = $this->conn->prepare("CALL insert_livro(?, ?, ?)");
            $stmt->bind_param("sii", $titulo, $ano, $id_autor);
            $stmt->execute();

            if ($stmt->error){
                throw new Exception("Error inserting autor: " . $stmt->error);
            }
            
        }   
        catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            $this->connection_handle->closeConnection();
        }
    }

    public function listar_livros(){
        $query = 'CALL list_livros()';
        try{
            $result = $this->conn->query($query);
            return $result;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->connection_handle->closeConnection();
        }
    }

    public function getLivroId(string $titulo){
        $query = 'SELECT id FROM livro WHERE livro.titulo = ?';
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $titulo);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                return $row['id'];
            }
            else{
                throw new Exception("Livro not found.");
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->connection_handle->closeConnection();
        }
    }

    public function deletarLivro(string $titulo_livro){
        $id_livro = $this->getLivroId($titulo_livro);
        $query = 'CALL dell_livro(?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$id_livro);
        try{
            $stmt->execute();
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->connection_handle->closeConnection();
        }
        
    }

    public function editarLivro(string $titulo, int $ano, $nome_autor){
        $autor_repository = new AutorRepository();
        $id_autor = $autor_repository->getAutorId($nome_autor);
        $livro_id = $this->getLivroId($titulo);
        $query = 'UPDATE livro SET livro.titulo = ? livro.ano = ? livro.fk_autor = ? WHERE livro.id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('siii',$titulo,$ano,$id_autor,$livro_id);
        
        try{
            $stmt->execute();
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->connection_handle->closeConnection();
        }
    }

    public function findById(int $id) {
        $this->openConnection();
        
        $sql = "SELECT titulo, ano, status, fk_autor FROM livro WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $this->conn->error);
        }

        $titulo = '';
        $ano = '';
        $status = false;
        $fk_autor = 'null';

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($titulo, $ano, $status, $fk_autor);

        if ($stmt->fetch()) {
            $stmt->close();
            $livro = new Livro($titulo, $ano, $fk_autor, $status);
            return $livro;
        }

        $stmt->close();
        return null;
    }
}
?>