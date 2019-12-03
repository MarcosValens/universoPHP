<?php
require_once __DIR__ . '/controller/PlanetFormController.php';
require_once __DIR__ . '/model/User.php';
$planetFormController = new PlanetFormController();
$planet = $planetFormController->doGet();
?>


<html>
<head>
    <title>Title</title>
</head>
<body>


<?php
include 'template/welcome.php';
include 'template/menu.php';
?>


<form action="PlanetForm.php" method="post">
    <input type="hidden" name="idPlanet" value="<?php echo (isset($planet))?$planet->id:'';?>">
    <label for="namePlanet">Name Planet:</label>
    <br>
    <input type="text" name="namePlanet" id="namePlanet" value="<?php echo (isset($planet))?$planet->nom:'';?>">
    <br>
    <label for="massPlanet">Mass:</label>
    <br>
    <input type="text" name="massPlanet" id="massPlanet" value="<?php echo (isset($planet))?$planet->massa:'';?>">
    <br>
    <label for="habitablePlanet">Habitable:</label>
    <br>
    <input type="checkbox" name="habitablePlanet" id="habitablePlanet"
           value="<?php echo (isset($planet))?$planet->habitable:'';?>">
    <br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
