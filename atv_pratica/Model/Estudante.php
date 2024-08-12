<?php 
class Estudante{
    private string $name;

    private int $id;

    public function __construct($name, $id){
        try{
            if (is_string($name) and is_int($id)){
                $this->name = $name;
                $this->id = $id;
            }
            else{
                throw new Exception("Nome and Id needs to be a string and a integer.");
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
        
    }
}
?>