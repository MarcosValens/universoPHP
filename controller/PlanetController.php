<?php
require_once __DIR__ . '/../dao/ConnectionMysql.php';
require_once __DIR__ . '/../dao/PlanetDAO.php';
require_once __DIR__ . '/../interceptor/RequestLoginFilter.php';
require_once __DIR__ . '/../model/Planet.php';

Class PlanetController {

    public function __construct() {
        RequestLoginFilter::doFilter();
        if($_POST){
            $this->doPost();
        }
    }

    public function doGet() {
        $connection = ConnectionMysql::getInstance();
        $planetDAO = new PlanetDAO($connection);
        $planets = $planetDAO->getAll();

        $obj = new stdClass();
        $obj->planets = $planets;

        return $obj;

    }

    public function doPost() {

        $connection = ConnectionMysql::getInstance();
        $planetDAO = new PlanetDAO($connection);
        $planetId = filter_input(INPUT_POST, "planetId", FILTER_SANITIZE_SPECIAL_CHARS);
        $planet = $planetDAO->get($planetId);
        $planetDAO->delete($planet);

    }

}