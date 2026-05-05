<?php
session_start();

$token = $_POST['h-captcha-response'];
$secret = "0x3c4aEBD62D400969dAc304493F13A8E9cc3eeee3";
$post_data = 
[
    'secret' => $secret,
    'response' => $_POST['h-captcha-response']
];

$response = apiRequest("https://hcaptcha.com/siteverify",$post_data);

$json = json_decode($response);

if ($json->success) {

$servername = "localhost";
$username = "pterodactyl";
$password = "AH252938";
$dbname = "points";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION['user'])) header("Location: ../../");
$user = $_SESSION['user']->id;

$sql = "SELECT * FROM points WHERE id='" . $user . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql = "SELECT * FROM plans WHERE name='" . $_POST['plan'] . "'";
$result = $conn->query($sql);
$plan = $result->fetch_assoc();

if (!isset($plan['points'])) die();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/servers/" . $_POST['server'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Authorization: Bearer Wa0ytO9is1Bns9zxSQwjvIPENH0oOXmHmxu598JMNDYLdhA4"
  )
));
 
$servers = json_decode(curl_exec($curl));
$owned;
$server;
if ($servers->attributes->user == $row['panel']) {
$owned = true;
$server = $servers->attributes;
} else die("You don't own this server!");

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/servers/" . $_POST['server'] . "/build",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PATCH",
  CURLOPT_POSTFIELDS => '{"allocation": "' . $server->allocation . '","memory": ' . $plan['ram'] . ',"swap": 0,"disk": ' . $plan['disk'] . ',"io": 500,"cpu": ' . $plan['cpu'] . ',"threads": null,"feature_limits": {"databases": 0,"allocations": 0,"backups": 0}}',
  CURLOPT_COOKIE => 'pterodactyl_session=eyJpdiI6InhIVXp5ZE43WlMxUU1NQ1pyNWRFa1E9PSIsInZhbHVlIjoiQTNpcE9JV3FlcmZ6Ym9vS0dBTmxXMGtST2xyTFJvVEM5NWVWbVFJSnV6S1dwcTVGWHBhZzdjMHpkN0RNdDVkQiIsIm1hYyI6IjAxYTI5NDY1OWMzNDJlZWU2OTc3ZDYxYzIyMzlhZTFiYWY1ZjgwMjAwZjY3MDU4ZDYwMzhjOTRmYjMzNDliN2YifQ%253D%253D',
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer Wa0ytO9is1Bns9zxSQwjvIPENH0oOXmHmxu598JMNDYLdhA4"
  )
));

$response = curl_exec($curl);
$err = curl_error($curl);


if ($err) die("Error " . $err);
else {
  $newPPD = intval($row['ppd']) - intval($server->description) + intval($plan['points']);
  $sql = "UPDATE points SET ppd='" . $newPPD . "' WHERE id='" . $user . "'";
if ($conn->query($sql) === TRUE) {
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://gp.micronodes.tech/api/application/servers/" . $_POST['server'] . "/details",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PATCH",
    CURLOPT_POSTFIELDS => '{"name": "' . $server->name . '","user": "' . $row['panel'] . '","description": "' . $plan['points'] . '"}',
    CURLOPT_COOKIE => 'pterodactyl_session=eyJpdiI6InhIVXp5ZE43WlMxUU1NQ1pyNWRFa1E9PSIsInZhbHVlIjoiQTNpcE9JV3FlcmZ6Ym9vS0dBTmxXMGtST2xyTFJvVEM5NWVWbVFJSnV6S1dwcTVGWHBhZzdjMHpkN0RNdDVkQiIsIm1hYyI6IjAxYTI5NDY1OWMzNDJlZWU2OTc3ZDYxYzIyMzlhZTFiYWY1ZjgwMjAwZjY3MDU4ZDYwMzhjOTRmYjMzNDliN2YifQ%253D%253D',
    CURLOPT_HTTPHEADER => array(
      "Accept: application/json",
      "Content-Type: application/json",
      "Authorization: Bearer Wa0ytO9is1Bns9zxSQwjvIPENH0oOXmHmxu598JMNDYLdhA4"
    )
  ));

$response = curl_exec($curl);
$err = curl_error($curl);

  header("Location: ./?success=true");
} else {
  echo "Error Occured!";
}
}
} else {
  header("Location: ./?err=captcha");
}

curl_close($curl);


function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);


  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

  $headers[] = 'Accept: application/json';

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  return $response;
}

?>
