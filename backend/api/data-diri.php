<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include dirname(dirname(__FILE__)).'/db.php';

$nik = isset($_GET['nik']) ? $_GET['nik'] : 0;

$query = "SELECT foto, nik, nama, email, gender, tempat_lahir, tanggallahir, pendidikan, file_cv
          FROM seeker
          WHERE nik = $nik ";

$result = mysqli_query($koneksi, $query);
$output = array();

while($row = mysqli_fetch_assoc($result)) {
  $output[] = $row;
}

$koneksi->close();

echo json_encode($output);