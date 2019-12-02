<html>
<head>
    <title>Prueba de PHP</title>
</head>
<body>
<?php
require_once __DIR__ . "/dao/PlanetDAO.php";
require_once __DIR__ . "/dao/ConnectionMysql.php";
$connection = ConnectionMysql::getInstance();
$planetDAO = new PlanetDAO($connection);

$planet = $planetDAO->get(10);
$planets = $planetDAO->getAll();
echo '<p>Hola Mundo</p>'; ?>
</body>
</html>