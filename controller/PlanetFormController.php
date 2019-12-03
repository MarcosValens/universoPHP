<?php

require_once __DIR__ . '/../dao/ConnectionMysql.php';
require_once __DIR__ . '/../dao/PlanetDAO.php';
require_once __DIR__ . '/../interceptor/RequestLoginFilter.php';
require_once __DIR__ . '/../model/Planet.php';

class PlanetFormController
{
    public function __construct()
    {
        RequestLoginFilter::doFilter();
        if ($_POST) {
            $this->doPost();
        }
    }

    public function doGet()
    {
        $idPlanet = filter_input(INPUT_GET, "id");
        $connection = ConnectionMysql::getInstance();
        $planetDao = new PlanetDAO($connection);

        if (isset($idPlanet)) {
            return $planetDao->get($idPlanet);
        }
        return null;
    }

    public function doPost()
    {

        $planetName = filter_input(INPUT_POST, "namePlanet", FILTER_SANITIZE_SPECIAL_CHARS);
        $massPlanet = filter_input(INPUT_POST, "massPlanet", FILTER_SANITIZE_SPECIAL_CHARS);
        $habitablePlanet = filter_input(INPUT_POST, "habitablePlanet", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        $connection = ConnectionMysql::getInstance();
        $planetDao = new PlanetDAO($connection);
        $planet = new Planet();
        if (isset($_POST['habitablePlanet'])){
           $planet->habitable = 1;
        } else {
            $planet->habitable = 0;
        }
        $planet->nom = $planetName;
        $planet->massa = $massPlanet;

        if (isset($_POST['idPlanet']) && $_POST['idPlanet'] != "") {
            print_r("update");
            $planet->id = $_POST['idPlanet'];
            $planetDao->update($planet);
        } else {
            print_r($planet);
            print_r("save");
            $planetDao->save($planet);
        }
        header('Location: planets.php');

    }
}