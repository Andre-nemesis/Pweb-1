<?php

namespace Repository;

require_once '../../Model/Estudante.php';
require_once '../../db/DBConnectionHandler.php';

use Exception;
use db\DBConectionHandler;
use Model\Estudante;

class EstudanteRepository {
    /**
     * Classe de EstudanteRepository
     * Classe referente a gestão de da entrada de dados referente ao modelo Estudante.
     *
     * @author André Casimiro <andre.casimiro@gmail.com>
     * @author Geovanna <fgeovanna111@gmail.com>
     * @version 1.0
     */
    private DBConectionHandler $conection_handle;
    private $conn;

    public function __construct() {}

    public function openConnection(){
        $this->conection_handle = new DBConectionHandler();
        $this->conn = $this->conection_handle->getConnection();
    }

    public function CadastrarEstudante(Estudante $estudante) {
        $nome = $estudante->getNome();

        $this->openConnection();
        try{
            $stmt = $this->conn->prepare("CALL insert_estudante(?)");
            $stmt->bind_param("s", $nome);
            $stmt->execute();
            if ($stmt->error){
                throw new Exception("Error inserting estudante: " . $stmt->error);
            }
            $stmt->close();
            
        }   
        catch (Exception $e) {
            echo $e->getMessage();
        }
        finally{
            if (mysqli_ping($this->conn)){
                $this->conn->close();
            }
        }
    }

    public function listar_estudantes(){
        $this->openConnection();
        $query = 'CALL list_estudante()';
        try{
            $result = $this->conn->query($query);
            $estudantes = [];
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    $estudantes[] = new Estudante($row['nome_estudante'],$row['id']);
                }
                
                $result->free();
                return $estudantes;
            }
            else{
                throw new Exception("Can't find Estudantes");
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->conn->close();
        }
    }

    // Retornar o ID do estudante com base no seu nome
    public function getEstudanteId(string $nome_estudante){
        $this->openConnection();
        $query = "SELECT getEstudante_id(?) AS 'id'";
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $nome_estudante);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $stmt->close();
                return $row['id'];
            }
            else{
                throw new Exception("Estudante not found.");
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

    public function deletarEstudante(int $id_estudante){
        $this->openConnection();
        
        $query = 'CALL dell_estudante(?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$id_estudante);
        try{
            $stmt->execute();
            
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

    public function editarEstudante(Estudante $estudante,string $nome_antigo){
        $nome = $estudante->getNome();
        $estudante_id = $this->getEstudanteId($nome_antigo);

        $this->openConnection();
        $query = 'UPDATE estudante SET estudante.nome_estudante = ? WHERE estudante.id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('si', $nome, $estudante_id);
        
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

    // Buscar um autor pelo seu ID
    public function findById(int $id) {
        $this->openConnection();
        
        $sql = "SELECT id, nome_estudante FROM estudante WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $this->conn->error);
        }
        $nome= '';

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $nome);

        if ($stmt->fetch()) {
            $stmt->close();
            $estudante =  new Estudante($nome, $id);
            return $estudante;
        }

        $stmt->close();
        return null;
    }

}

?>