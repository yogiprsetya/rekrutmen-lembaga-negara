<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/db.php';

$nik        = addslashes(htmlentities($_POST['nik']));
$nama       = addslashes(htmlentities($_POST['nama']));
$email      = addslashes(htmlentities($_POST['email']));
$katasandi  = md5(addslashes(htmlentities($_POST['katasandi'])));

$insert = "INSERT INTO seeker(foto, nik,nama,email,katasandi)
           VALUES ('static/no-image.png','$nik','$nama','$email','$katasandi')";

$exeinsert = mysqli_query($koneksi,$insert);

$response = array();

if($exeinsert) {
    $response['code'] =1;
    $response['message'] = "Success! Data Inserted";
} else {
    $response['code'] = mysqli_errno();
    $response['message'] = "Data Not Inserted";
}

echo json_encode($response);