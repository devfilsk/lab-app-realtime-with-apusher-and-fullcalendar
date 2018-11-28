<?php
echo date("d.m.Y H:i:s"); exit;
header("Content-Type: application/json");

require "conexao.php";

$sql = "select * from agendamentos";

$query = $conn->query($sql);
$rows = $conn->fetchAll(PDO::FETCH_ASSOC);

$resultado = [];
foreach ($rows as $i => $row){
    $resultado[$i]['id'] = (int)$row['id'];
    $resultado[$i]['title'] = $row['nome'];
    $resultado[$i]['start'] = date('Y-m-d\TH:i:s', strtotime($row['inicio']));
    $resultado[$i]['end'] = date('Y-m-d\TH:i:s', strtotime($row['fim']));

}

echo json_encode($resultado);

?>