<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include dirname(dirname(__FILE__)).'/db.php';

$query = "SELECT data_lamaran.id, lembaga_negara.nama_lembaga, posisi.nama_posisi, seeker.nama, data_lamaran.status
          FROM data_lamaran
          INNER JOIN jobs ON data_lamaran.jobs = jobs.id
          INNER JOIN posisi ON jobs.id_posisi = posisi.id
          INNER JOIN lembaga_negara ON jobs.id_lembaga = lembaga_negara.id
          INNER JOIN seeker ON data_lamaran.nik = seeker.nik";

$result = mysqli_query($koneksi,$query);
$array_data = array();

while($baris = mysqli_fetch_assoc($result)) {
  $array_data[]=$baris;
}

echo json_encode($array_data);
