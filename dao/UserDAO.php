<?php
require_once __DIR__ . "/DAO.php";
require_once __DIR__ . "/../model/User.php";

class UserDAO implements DAO {

    private $conn;

    public function __construct($connectionInterface) {
        $this->conn = $connectionInterface;
    }


    public function validate($name, $password) {
        $sql = "SELECT * FROM usuari WHERE nom=? AND password=?";
        try {
            $preparedStatement = $this->conn->connection()->prepare($sql);
            $preparedStatement->execute(array($name, $password));
            $user = $preparedStatement->fetchObject();

            if (isset($user) && isset($user->nom)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            print_r($e);
            return null;
        }
    }

    public function getByUserName($name) {
        $sql = "SELECT * FROM usuari WHERE nom=?";
        try {
            $preparedStatement = $this->conn->connection()->prepare($sql);
            $preparedStatement->execute(array($name));
            $user = $preparedStatement->fetchObject();
            $userReturn = new User();
            $userReturn->id = $user->idusuari; //<-- objeto recuperado de la base de datos
            $userReturn->name = $user->nom; //<-- objeto recuperado de la base de datos

            return $userReturn;

        } catch (Exception $e) {
            print_r($e);
            return null;
        }
    }

    public function get($id) {
        try {
            $sql = "SELECT * FROM planeta WHERE idplaneta=?";

            $prepared = $this->conn->connection()->prepare($sql);
            $prepared->execute(array($id));
            $planet = $prepared->fetchObject();
            $planetReturn = new Planet();
            $planetReturn->nom = $planet->nom;
            $planetReturn->id = $planet->idplaneta;
            $planetReturn->massa = $planet->massa;
            $planetReturn->habitable = $planet->habitable;

            return $planetReturn;
        } catch (PDOException $e) {
            print_r($e);
        }

    }

    function getAll() {
        try {
            $sql = "SELECT * FROM planeta";
            $prepared = $this->conn->connection()->prepare($sql);
            $prepared->execute();
            $planets = $prepared->fetchAll();
            $planetsReturn = array();
            foreach ($planets as $planet) {
                $planetReturn = new Planet();
                $planetReturn->nom = $planet['nom'];
                $planetReturn->id = $planet['idplaneta'];
                $planetReturn->massa = $planet['massa'];
                $planetReturn->habitable = $planet['habitable'];
                array_push($planetsReturn, $planetReturn);
            }
            return $planetsReturn;
        } catch (PDOException $e) {
            print_r($e);
        }
        return null;
    }

    function save($obj) {
        try {
            $sql = "INSERT INTO planeta(nom,massa,habitable) VALUES(?,?,?)";
            $prepared = $this->conn->connection()->prepare($sql);
            $prepared->execute(array($obj->nom, $obj->massa, $obj->habitable));
        } catch (PDOException $e) {
            print_r($e);
        }
        return null;
    }

    function update($obj) {
        try {
            $sql = "UPDATE planeta SET nom=?,massa=?,habitable=? WHERE idplaneta=?";
            $prepared = $this->conn->connection()->prepare($sql);
            $prepared->execute(array($obj->nom, $obj->massa, $obj->habitable, $obj->id));
        } catch (PDOException $e) {
            print_r($e);
        }
        return null;
    }

    function delete($obj) {
        try {
            $sql = "DELETE FROM planeta WHERE idplaneta=?";
            $prepared = $this->conn->connection()->prepare($sql);
            $prepared->execute(array($obj->id));
        } catch (PDOException $e) {
            print_r($e);
        }
        return null;
    }
}





