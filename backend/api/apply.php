<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/db.php';

$nik    = addslashes(htmlentities($_POST['nik']));
$jobs   = addslashes(htmlentities($_POST['jobs']));

$cekQ   = "SELECT * FROM data_lamaran WHERE nik='$nik' AND jobs='$jobs'";
$cekIsi = mysqli_query($koneksi, $cekQ);
$cek    = mysqli_num_rows($cekIsi);

$response = array();

if($cek == 0) {
$insert = "INSERT INTO data_lamaran(id,nik,jobs,status) VALUES ('','$nik','$jobs','seleksi')";
$exequery = mysqli_query($koneksi,$insert);
    if($exequery) {
        $response['message'] = "Berhasil!";
    } else {
        $response['code'] = mysqli_errno();
        $response['message'] = "Shit! Data Not Inserted";
    }
} else {
    $response['message'] = "Sudah pernah Apply!";
}

echo json_encode($response);