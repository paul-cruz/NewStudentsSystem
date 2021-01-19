<?php

class School {
    private $db;
    private $School;

    public function setSchool($school){
        $this->School = $school;
    }

    public function getSchool(){
        return $this->School;
    }

    public function __construct($db){
        $this->db = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM CatalogoDeEscuelas;";
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
    $school = new School($db);
    $school->read();
}

?>