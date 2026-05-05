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
if ($row['points'] < $row['ppd']) { 
  header("Location: ./?err=points");
  die();
}
if (!isset($plan['points'])) die();
$port = rand(1025,65535);
$conn1 = new mysqli($servername,$username,$password,"panel");
$sql2 = "SELECT * FROM allocations WHERE port='" . $port . "'";
$result2 = $conn1->query($sql2);
if ($result2->num_rows > 0) {
$port = rand(1025,65535);
$sql2 = "SELECT * FROM allocatons WHERE port='" . $port . "'";
$result2 = $conn1->query($sql2);
if ($result2->num_rows > 0) die("Looks like the node is full? Contact Support!");
}
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/nodes/3/allocations",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => '{"alias": "node3.micronodes.tech","ip": "0.0.0.0","ports": ["' . $port . '"]}',
  CURLOPT_COOKIE => 'pterodactyl_session=eyJpdiI6InhIVXp5ZE43WlMxUU1NQ1pyNWRFa1E9PSIsInZhbHVlIjoiQTNpcE9JV3FlcmZ6Ym9vS0dBTmxXMGtST2xyTFJvVEM5NWVWbVFJSnV6S1dwcTVGWHBhZzdjMHpkN0RNdDVkQiIsIm1hYyI6IjAxYTI5NDY1OWMzNDJlZWU2OTc3ZDYxYzIyMzlhZTFiYWY1ZjgwMjAwZjY3MDU4ZDYwMzhjOTRmYjMzNDliN2YifQ%253D%253D',
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer 73ee6j0DQT38l1fWD6qGNZ6z3XaiyD4xldaeYdb1u3M59ZIF"
  )
));

$response = curl_exec($curl);
$err = curl_error($curl);
if ($err) echo "Error " . $err;
else {
 echo "Done, Port is " . $port;

 $sql = "SELECT * FROM allocations WHERE port='" . $port . "'";
 $result = $conn1->query($sql);
 $row1 = $result->fetch_assoc();

 curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/nests/" . $_POST['servertype'] . "/eggs/" . $_POST['egg'] . "?include=variables",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_COOKIE => 'pterodactyl_session=eyJpdiI6InhIVXp5ZE43WlMxUU1NQ1pyNWRFa1E9PSIsInZhbHVlIjoiQTNpcE9JV3FlcmZ6Ym9vS0dBTmxXMGtST2xyTFJvVEM5NWVWbVFJSnV6S1dwcTVGWHBhZzdjMHpkN0RNdDVkQiIsIm1hYyI6IjAxYTI5NDY1OWMzNDJlZWU2OTc3ZDYxYzIyMzlhZTFiYWY1ZjgwMjAwZjY3MDU4ZDYwMzhjOTRmYjMzNDliN2YifQ%253D%253D',
  CURLOPTS_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer Wa0ytO9is1Bns9zxSQwjvIPENH0oOXmHmxu598JMNDYLdhA4"
  )
));
 
$egginfo = json_decode(curl_exec($curl));
$variables;
for ($i=0;$i<sizeof($egginfo->attributes->relationships->variables->data);$i++) {
  $variables = $variables . '"' . $egginfo->attributes->relationships->variables->data[$i]->attributes->env_variable . '":"' . $egginfo->attributes->relationships->variables->data[$i]->attributes->default_value . '"';
  if ($i+1 !== sizeof($egginfo->attributes->relationships->variables->data)) $variables = $variables . ","; 
}
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/servers",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => '{"name": "' . $_POST['plan'] . ' Server","user": ' . $row['panel'] . ', "description": "' . $plan['points'] . '" ,"egg": ' . $_POST['egg'] . ',"docker_image": "' . $egginfo->attributes->docker_image . '","startup": "' . str_replace('"',"'",$egginfo->attributes->startup) . '","environment": {' . $variables . '},"limits": {"memory": ' . $plan['ram'] . ',"swap": 0,"disk": ' . $plan['disk'] . ',"io": 500,"cpu": ' . $plan['cpu'] . '},"feature_limits": {"databases": 0,"backups": 0}, "allocation": {"default": ' . $row1['id'] . '}}',
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
  $newPPD = intval($row['ppd']) + $plan['points'];
  $sql = "UPDATE points SET ppd='" . $newPPD . "' WHERE id='" . $user . "'";
if ($conn->query($sql) === TRUE) {
  header("Location: ./?success=true");
} else {
  echo "Error Occured!";
}
}

}
curl_close($curl);
} else {
  header("Location: ./?err=captcha");
}


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
