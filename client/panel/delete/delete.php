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

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/users/" . $row['panel'] . "?include=servers",
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
for ($i=0;$i<sizeof($servers->attributes->relationships->servers->data);$i++) {
if ($servers->attributes->relationships->servers->data[$i]->attributes->id == $_POST['server']) {
$owned = true;
$server = $servers->attributes->relationships->servers->data[$i]->attributes;
break;
} else {
  if ($i == sizeof($servers->attributes->relationships->servers->data)-1) die("You don't own this server!");
}
}
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/servers/" . $_POST['server'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "DELETE",
  CURLOPT_COOKIE => 'pterodactyl_session=eyJpdiI6InhIVXp5ZE43WlMxUU1NQ1pyNWRFa1E9PSIsInZhbHVlIjoiQTNpcE9JV3FlcmZ6Ym9vS0dBTmxXMGtST2xyTFJvVEM5NWVWbVFJSnV6S1dwcTVGWHBhZzdjMHpkN0RNdDVkQiIsIm1hYyI6IjAxYTI5NDY1OWMzNDJlZWU2OTc3ZDYxYzIyMzlhZTFiYWY1ZjgwMjAwZjY3MDU4ZDYwMzhjOTRmYjMzNDliN2YifQ%253D%253D',
  CURLOPTS_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer Wa0ytO9is1Bns9zxSQwjvIPENH0oOXmHmxu598JMNDYLdhA4"
  )
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) die("Error " . $err);
else {
  $newPPD = intval($row['ppd']) - intval($server->description);
  $sql = "UPDATE points SET ppd='" . $newPPD . "' WHERE id='" . $user . "'";
if ($conn->query($sql) === TRUE) {
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
