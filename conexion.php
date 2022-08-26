<?php
$servidor= "10.128.0.2:3306";
$usuario= "mundocri_rdc";
$password = "aT[UM~l9#}JW";
$nombreBD= "mundocri_yeti556";
$db = new mysqli($servidor, $usuario, $password, $nombreBD);
if ($db->connect_error) {
    die("la conexión ha fallado: " . $db->connect_error);
}
if (!$db->set_charset("utf8")) {
    printf("Error al cargar el conjunto de caracteres utf8: %s\n", $db->error);
    exit();
} else {
    printf("Conjunto de caracteres actual: %s\n", $db->character_set_name());
}
?>