<?php
require_once __DIR__ . '/../dao/ConnectionMysql.php';
require_once __DIR__ . '/../dao/UserDAO.php';

Class LoginFormController {

    public function __construct() {
        if($_POST){
            $this->doPost();
        }
    }

    public function doGet() {
        $error = filter_input(INPUT_GET,"error");
        $obj = new stdClass();
        $obj->error = $error;

        return $obj;
    }

    public function doPost() {
        //$user = $_POST["user"] <-- Deprecated

        $user = filter_input(INPUT_POST,"user",FILTER_SANITIZE_SPECIAL_CHARS);
        $pwd = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
        $remember = filter_input(INPUT_POST,"remember",FILTER_VALIDATE_BOOLEAN,FILTER_NULL_ON_FAILURE);

        $connection = ConnectionMysql::getInstance();
        $userDao = new UserDAO($connection);

        if ($userDao->validate($user,$pwd)){
            $validUser = $userDao->getByUserName($user);


            session_start(); //SIN ESTO NO EXISTE LA VARIABLE $_SESSION

            $_SESSION["validated"] = "YES";
            $_SESSION["user"] = $validUser;
            $_SESSION["lastActiviy"] = new DateTime();

            header('Location: planets.php'); //ESTO SIEMPRE DEBE IR ANTES DE NADA
            exit;
        } else {
            header('Location: loginForm.php?error=true');
            exit;
        }
    }
}