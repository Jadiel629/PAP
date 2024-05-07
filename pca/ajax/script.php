<?php
require_once "../config/config.php";
require_once "../lib/KaasConnectionDB/kaasConnectionDB.php";

$post = json_decode(file_get_contents("php://input",true));
$data = $post->data;
$volumes = [];
$fluxos = [];

$timestamp = strtotime($data);
$data_formatada = date("Y-m-d",$timestamp);

$db = new KaasConnectionDB();
$resultado = $db->select("SELECT id, volume, fluxo FROM consumo WHERE created_at LIKE '".$data_formatada."%';");

foreach($resultado as $item){
    $volumes[] = $item["volume"];
    $fluxos[] = $item["fluxo"];
}

$array = [$volumes,$fluxos];

echo json_encode($array);  