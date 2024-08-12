<?php 

namespace Repository;

use db\DBConectionHandler;
use Model\Autor;
use Exception;

require_once './atv_pratica/Model/Autor.php';
require_once './atv_pratica/db/DBConnectionHandler.php';

class AutorRepository{
    private Autor $autor;
    private DBConectionHandler $connection_handle;
    private $conn;

    public function __construct(){
        $this->connection_handle = new DBConectionHandler();
        $this->conn = $this->connection_handle->getConnection();
    }

    public function cadastrarAutor($nome,$nacionalidade){
        $this->autor = new Autor($nome,$nacionalidade);
        $nome = $this->autor->getNome();
        $nacionalidade = $this->autor->getNascionalidade();
        try{
            $stmt = $this->conn->prepare("CALL insert_autor(?, ?)");
            $stmt->bind_param("ss", $nome,$nacionalidade);
            $stmt->execute();

            $this->autor->setId($this->getAutorId($nome));
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

    public function listar_autores(){
        $query = 'CALL list_autor()';
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

    public function getAutorId(string $nome_autor){
        $query = 'SELECT id FROM autor WHERE autor.id = ?';
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $nome_autor);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                return $row['id'];
            }
            else{
                throw new Exception("Autor not found.");
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->connection_handle->closeConnection();
        }
    }

    public function deletarAutor(string $autor_nome){
        $id_autor = $this->getAutorId($autor_nome);
        $query = 'CALL dell_autor(?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$id_autor);
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

    public function editarAutor($nome_autor,$nacionalidade){
        $autor_id = $this->getAutorId($nome_autor);
        $query = 'UPDATE autor SET autor.name = ? autor.nacionalidade = ? WHERE autor.id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssi',$nome_autor,$nacionalidade,$autor_id);
        
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
}
?>