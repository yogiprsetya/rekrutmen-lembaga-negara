<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/db.php';

$nik = isset($_GET['nik']) ? $_GET['nik'] : 0;

$query = "SELECT lembaga_negara.nama, posisi.nama_posisi, data_lamaran.status
          FROM data_lamaran
          INNER JOIN jobs ON data_lamaran.jobs = jobs.id
          INNER JOIN posisi ON jobs.id_posisi = posisi.id
          INNER JOIN lembaga_negara ON jobs.id_lembaga = lembaga_negara.id
          WHERE data_lamaran.nik = $nik ";

$result = mysqli_query($koneksi, $query);

while($row = mysqli_fetch_assoc($result)) {
  $output = array($row);
}

$koneksi->close();

echo json_encode($output);