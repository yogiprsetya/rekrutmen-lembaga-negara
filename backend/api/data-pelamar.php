<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include dirname(dirname(__FILE__)).'/db.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$query = "SELECT seeker.*, lembaga_negara.nama_lembaga, posisi.nama_posisi, data_lamaran.status
          FROM data_lamaran
          INNER JOIN seeker ON data_lamaran.nik = seeker.nik
          INNER JOIN jobs ON data_lamaran.jobs = jobs.id
          INNER JOIN posisi ON jobs.id_posisi = posisi.id
          INNER JOIN lembaga_negara ON jobs.id_lembaga = lembaga_negara.id
          WHERE data_lamaran.id = $id ";

$result = mysqli_query($koneksi, $query);
$output = array();

while($row = mysqli_fetch_assoc($result)) {
  $output[] = $row;
}

$koneksi->close();

echo json_encode($output);