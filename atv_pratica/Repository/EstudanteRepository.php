<?php

namespace Repository;

require_once '../Model/Estudante.php';
require_once '../db/DBConnectionHandler.php';

use Exception;
use db\DBConectionHandler;
use Model\Estudante;

class EstudanteRepository {
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
            $stmt->bind_param("ss", $nome);
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
                while ($row = $result->fetch_assoc())
                $estudantes[] = new Estudante($row['id'], $row['name']);
                $result->free();
                return $estudantes;
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        finally{
            $this->conn->close();
        }
    }

    public function getEstudanteId(string $nome_estudante){
        $this->openConnection();
        $query = "SELECT getEstudante_id('estudante teste') as 'id'";
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
            $this->conn->close();
        }
        
    }

    public function deletarEstudante(string $nome){
        $id_estudante = $this->getEstudanteId($nome);
        $this->openConnection();
        
        $query = 'CALL dell_estudante(?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('d',$id_estudante);
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

    public function editarEstudante(Estudante $estudante){
        $nome = $estudante->getNome();
        $estudante_id = $this->getEstudanteId($estudante->getNome());

        $this->openConnection();
        $query = 'UPDATE estudante SET estudante.name = ? WHERE estudante.id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssi', $nome, $estudante_id);
        
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

    public function findById(int $id) {
        $this->openConnection();
        
        $sql = "SELECT id, nome FROM estudante WHERE id=?";
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
            $estudante =  new Estudante($id, $nome);
            return $estudante;
        }

        $stmt->close();
        return null;
    }

}

?>