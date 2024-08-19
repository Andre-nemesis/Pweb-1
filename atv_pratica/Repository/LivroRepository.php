<?php 
namespace Repository;

use db\DBConectionHandler;
use Model\Livro;
use Exception;
use Repository\AutorRepository;

require_once '../Repository/AutorRespository.php';
require_once '../Model/Livro.php';
require_once '../db/DBConnectionHandler.php';

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
        $this->openConnection();
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
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
    }

    public function listar_livros(){
        $this->openConnection();
        $query = 'CALL list_livros()';
        $livros = [];
        try{
            $result = $this->conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $livros[] = new Livro($row['titulo'],
                                        $row['ano'],$row['fk_autor'],
                                        $row['status'],$row['id']);
                }
                $result->free();
                return $livros;
            }
            
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->conn->close();
        }
    }

    public function getLivroId(string $titulo){
        $this->openConnection();
        $query = "SELECT getLivro_id(?) AS 'id';";
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
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
    }

    public function deletarLivro(int $id_livro){
        $this->openConnection();
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
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
        
    }

    public function editarLivro(Livro $livro){
        
        $titulo = $livro->getTitulo();
        $id_autor = $livro->getAutor();
        $ano = $livro->getAno();
        $livro_id = $this->getLivroId($livro->getTitulo());
        $this->openConnection();
        $query = 'UPDATE livro SET livro.titulo = ? livro.ano = ? livro.fk_autor = ? WHERE livro.id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('siii',$titulo,$ano,$id_autor,$livro_id);
        
        try{
            $stmt->execute();
            $stmt->close();
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->conn->close();
        }
    }

    public function findById(int $id) {
        $this->openConnection();
        try{
            $sql = "SELECT titulo, ano, status, fk_autor FROM livro WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $this->conn->error);
        }

        $titulo = '';
        $ano = '';
        $status = true;
        $fk_autor = 'null';

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($titulo, $ano, $status, $fk_autor);

        if ($stmt->fetch()) {
            $stmt->close();
            $livro = new Livro($titulo, $ano, $fk_autor, $status,$id);
            return $livro;
        }

        $stmt->close();
        return null;
        }
        
        catch(Exception $e){
            echo $e->getMessage();
        }

        finally{
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
        
    }
}
?>