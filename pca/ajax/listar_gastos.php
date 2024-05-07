<?php

require_once "../config/config.php";
require_once "../lib/KaasConnectionDB/kaasConnectionDB.php";

$db = new KaasConnectionDB();

$resultado = $db->select("SELECT * FROM consumo");

echo json_encode($resultado);