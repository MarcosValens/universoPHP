<?php
session_start();
$userName = $_SESSION["user"]->name;
?>
<h1>Hola <?php echo $userName ?></h1>