<?php
header('Content-Type: application/json');
include dirname(dirname(__FILE__)).'/db/.php';

$nik = addslashes(htmlentities($_POST['nik']));
$nama = addslashes(htmlentities($_POST['nama']));
$tempat_lahir = addslashes(htmlentities($_POST['tempat_lahir']));
$ttl = addslashes(htmlentities($_POST['ttl']));
$pendidikan = addslashes(htmlentities($_POST['pendidikan']));
$file_cv = addslashes(htmlentities($_POST['file_cv']));

$insert = "INSERT INTO seeker(nik,nama,tempat_lahir,ttl,pendidikan,file_cv)
           VALUES ('$nik','$nama','$tempat_lahir','$ttl','$pendidikan','$file_cv')";

$exeinsert = mysqli_query($koneksi,$insert);

$response = array();

if($exeinsert) {
    $response['code'] =1;
    $response['message'] = "Success! Data Inserted";
} else {
    $response['code'] = mysqli_errno();
    $response['message'] = "Shit! Data Not Inserted";
}

echo json_encode($response);