<?php

class Group {
    private $db;
    private $Group;

    public function setGroup($group){
        $this->Group = $group;
    }

    public function getGroup(){
        return $this->Group;
    }

    public function __construct($db){
        $this->db = $db;
    }

    public function read($id)
    {
        $query = "SELECT * FROM Grupo WHERE idGrupo='" . $id["idGrupo"] . "';";
        $result = $this->db->executeQuery($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row["idUsuario"] . "," . $row["horaExamen"] . "," . $row["inscritos"];
            }
        } else {
            echo "0 results";
        }
    }

    public function create($data)
    {
        $query = "INSERT INTO Grupo VALUES (null, '".$data["hour"]."', 0)";
        $result = $this->db->executeQuery($query);
        var_dump($result);
    }

    public function update($data)
    {
        $query = "UPDATE Grupo SET horaExamen = '".$data["horarioUp"]."', inscritos = ".$data["inscritos"]." WHERE idGrupo = ".$data["idGrupo"];
        $result = $this->db->executeQuery($query);
        var_dump($result);
    }

    public function delete($data)
    {
        $query = "DELETE FROM Grupo WHERE idGrupo = ".$data["idGrupo"];
        $result = $this->db->executeQuery($query);
        var_dump($result);
    }
}

if(isset($_REQUEST["post"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $group = new Group($db);
    $group->create($_REQUEST["post"]);
}

if(isset($_REQUEST["update"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $group = new Group($db);
    $group->update($_REQUEST["update"]);
}

if(isset($_REQUEST["delete"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $group = new Group($db);
    $group->delete($_REQUEST["delete"]);
}

if (isset($_REQUEST["get"])) {
    require_once("../controllers/db.class.php");
    $db = new DB();
    $group = new Group($db);
    $group->read($_REQUEST["get"]);
}
?>