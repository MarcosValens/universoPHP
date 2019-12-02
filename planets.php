<?php
require_once __DIR__ . '/controller/PlanetController.php';
$planetController = new PlanetController();
$obj = $planetController->doGet();
$planets = $obj->planets;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Title</title>
</head>
<body>
<?php
include 'template/welcome.php';
include 'template/menu.php';
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Mass</th>
        <th>Habitable</th>
        <th>Operations</th>
    </tr>
    <?php
    foreach ($planets as $planet) {
        echo '<tr>';
        echo "<td>$planet->id</td>";
        echo "<td>$planet->nom</td>";
        echo "<td>$planet->massa</td>";
        echo "<td>";
        echo ($planet->habitable) ? "Si" : "No";
        echo "</td>";
        echo "<td>";
        echo '<a href = "PlanetForm.php?id=' . $planet->id . '">Edit</a>';
        echo "</td>";
        echo "<td>";
        echo '<form action = "planets.php" method = "post" >';
        echo "<button type = \"submit\" >Delete</button >";
        echo "<input type = \"hidden\" name = \"planetId\" value = \"" . $planet->id . "\">";
        echo '</form >';
        echo '</td >';
        echo '</tr >';
    }
    ?>

    </c:forEach>
</table>
</body>
</html>