<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include dirname(dirname(__FILE__)).'/db.php';
include dirname(dirname(__FILE__)).'/s3-upload/auth.php';
include dirname(dirname(__FILE__)).'/s3-upload/S3.php';

$nik          = addslashes(htmlentities($_POST['nik']));
$nama         = addslashes(htmlentities($_POST['nama']));
$email        = addslashes(htmlentities($_POST['email']));
$gender       = addslashes(htmlentities($_POST['gender']));
$tempat_lahir = addslashes(htmlentities($_POST['tempat_lahir']));
$tanggallahir = addslashes(htmlentities($_POST['tanggallahir']));
$pendidikan   = addslashes(htmlentities($_POST['pendidikan']));

$foto         = $_FILES['foto']['name'];
$file_cv      = $_FILES['file_cv']['name'];
$fotoTmp      = $_FILES['foto']['tmp_name'];
$cvTmp        = $_FILES['file_cv']['tmp_name'];

if (defined('AWS_S3_URL')) {
  S3::setAuth(AWS_S3_KEY, AWS_S3_SECRET);
  S3::setRegion(AWS_S3_REGION);
  S3::setSignatureVersion('v4');
  S3::putObject(S3::inputFile($fotoTmp), AWS_S3_BUCKET, 'berkas/' .$nik. '/' .$foto, S3::ACL_PUBLIC_READ);
  unlink($fotoTmp);
  S3::putObject(S3::inputFile($cvTmp), AWS_S3_BUCKET, 'berkas/' .$nik. '/' .$file_cv, S3::ACL_PUBLIC_READ);
  unlink($cvTmp);
} else {
  $pathFoto = 'berkas/' .$nik. '/' .$foto;
  $pathCV = 'berkas/' .$nik. '/' .$file_cv;
  move_uploaded_file($fotoTmp, $pathFoto);
  move_uploaded_file($cvTmp, $pathCV);
}

$dirUpload = AWS_S3_URL.'berkas/' .$nik. '/';

$update = "UPDATE seeker SET
           foto='$dirUpload$foto', nama='$nama', email='$email', gender='$gender',
           tempat_lahir='$tempat_lahir', tanggallahir='$tanggallahir', pendidikan='$pendidikan', file_cv='$dirUpload$file_cv'
           WHERE nik='$nik'";
$exequery = mysqli_query($koneksi,$update);

$respose = array();

if($exequery) {
  $respose['code'] = 1;
  $respose['message'] = "Updated Success";
} else {
  $respose['code'] = 0;
  $respose['message'] = "Updated Failed";
}
  
echo json_encode($respose);
exit;