<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include dirname(dirname(__FILE__)).'/db.php';

$lembaga = isset($_GET['lembaga']) ? $_GET['lembaga'] : '';

$query = "SELECT jobs.id, lembaga_negara.nama, posisi.nama_posisi, jobs.jumlah, jobs.pendidikan
          FROM jobs
          INNER JOIN lembaga_negara ON jobs.id_lembaga = lembaga_negara.id
          INNER JOIN posisi ON jobs.id_posisi = posisi.id
          WHERE jobs.id_lembaga = '$lembaga' ";

$result = mysqli_query($koneksi, $query);
$output = array();

while($row = mysqli_fetch_assoc($result)) {
  $output[] = $row;
}

$koneksi->close();

echo json_encode($output);