<?php

class Student {
    private $db;
    private $Student;

    public function setStudent($student){
        $this->Student = $student;
    }

    public function getState(){
        return $this->Student;
    }

    public function __construct($db){
        $this->db = $db;
    }

    public function read($id)
    {
        $query = "SELECT * FROM Usuario WHERE idUsuario='" . $id["boleta"] . "';";
        $result = $this->db->executeQuery($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row["idUsuario"] . "," . $row["clave"] . "," . $row["rol"];
            }
        } else {
            echo "0 results";
        }
    }

    public function create($data)
    {
        $query = "INSERT INTO Usuario VALUES ('".$data["boleta"]."', '".$data["clave"]."', 2)";
        $result = $this->db->executeQuery($query);
        var_dump($result);
    }

    public function update($data)
    {
        $query = "UPDATE Usuario SET clave = '".$data["clave"]."' WHERE idUsuario = '".$data["boleta"]."'";
        $result = $this->db->executeQuery($query);
    }

    public function delete($data)
    {
        $query = "DELETE FROM Alumno WHERE boleta ='".$data["boleta"]."'";
        $result = $this->db->executeQuery($query);
        $query = "DELETE FROM Usuario WHERE idUsuario = '".$data["boleta"]."'";
        $result = $this->db->executeQuery($query);
    }
}

if(isset($_REQUEST["delete"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $student = new Student($db);
    $student->delete($_REQUEST["delete"]);
}

if(isset($_REQUEST["update"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $student = new Student($db);
    $student->update($_REQUEST["update"]);
}

if(isset($_REQUEST["post"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $student = new Student($db);
    $student->create($_REQUEST["post"]);
}

if (isset($_REQUEST["get"])) {
    require_once("../controllers/db.class.php");
    $db = new DB();
    $student = new Student($db);
    $student->read($_REQUEST["get"]);
}
?>