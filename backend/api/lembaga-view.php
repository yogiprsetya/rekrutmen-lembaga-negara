<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include dirname(dirname(__FILE__)).'/db.php';

$query = "SELECT * FROM lembaga_negara";

$result = mysqli_query($koneksi,$query);
$array_data = array();

while($baris = mysqli_fetch_assoc($result)) {
  $array_data[]=$baris;
}

echo json_encode($array_data);
