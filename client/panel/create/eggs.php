<?php
if (!isset($_GET['nest'])) die("No nest given");
header("Content-Type: application/json");
session_start();

if (!isset($_SESSION['user'])) header("Location: ../../");
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/nests/" . $_GET['nest'] . "?include=eggs",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Authorization: Bearer 1juhX2HMupgHfw8VG04tyHnMUTEvzLunLCGYb3WaHoVtWUFP"
  )
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

echo json_encode(json_decode($response)->attributes->relationships->eggs->data);

?>
