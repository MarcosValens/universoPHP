


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
    <input type="hidden" name="idPlanet" value="${planet.getId()}">
    <label for="namePlanet">Name Planet:</label>
    <br>
    <input type="text" name="namePlanet" id="namePlanet" value="${planet.getName()}">
    <br>
    <label for="massPlanet">Mass:</label>
    <br>
    <input type="text" name="massPlanet" id="massPlanet" value="${planet.getMass()}">
    <br>
    <label for="habitablePlanet">Habitable:</label>
    <br>
    <input type="checkbox" name="habitablePlanet" id="habitablePlanet"
           value="SI" ${(planet.isHabitable())?"checked":""}>
    <br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
