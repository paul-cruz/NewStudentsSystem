<?php

class State {
    private $db;
    private $State;

    public function setState($state){
        $this->State = $state;
    }

    public function getState(){
        return $this->State;
    }

    public function __construct($db){
        $this->db = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM EntidadFederativa;";
        $result = $this->db->executeQuery($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo $row["nombre"].",";
            }
          } else {
            echo "0 results";
          }
    }

    public function create($data)
    {
        # code...
    }

    public function update($id)
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }
}

if(isset($_REQUEST["data"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $state = new State($db);
    $state->read();
}

?>