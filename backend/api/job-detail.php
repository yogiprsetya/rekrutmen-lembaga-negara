<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/db.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$query = "SELECT lembaga_negara.nama, posisi.nama_posisi, jobs.pendidikan, jobs.kualifikasi
          FROM jobs
          INNER JOIN lembaga_negara ON jobs.id_lembaga = lembaga_negara.id
          INNER JOIN posisi ON jobs.id_posisi = posisi.id
          WHERE jobs.id = $id ";

$result = mysqli_query($koneksi, $query);

while($row = mysqli_fetch_assoc($result)) {
  $output = array($row);
}

$koneksi->close();

echo json_encode($output);