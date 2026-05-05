<?php
//die("Client Panel is under development");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

session_start();

error_reporting(E_ALL);

define('OAUTH2_CLIENT_ID', '805495474302746684');
define('OAUTH2_CLIENT_SECRET', 'PY_W5tSXpl25xJc7nFgzzl2gau_zDoK9');

$authorizeURL = 'https://discord.com/api/oauth2/authorize';
$tokenURL = 'https://discord.com/api/oauth2/token';
$apiURLBase = 'https://discord.com/api/users/@me';

// Start the login process by sending the user to Discord's authorization page
if(get('action') == 'login') {

  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => 'https://micronodes.tech/client/login.php',
    'response_type' => 'code',
    'scope' => 'identify email'
  );

  // Redirect the user to Discord's authorization page
  header('Location: https://discord.com/api/oauth2/authorize' . '?' . http_build_query($params));
  die();
}


// When Discord redirects the user back here, there will be a "code" and "state" parameter in the query string
if(get('code')) {

  // Exchange the auth code for a token
  $token = apiRequest($tokenURL, array(
    "grant_type" => "authorization_code",
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'redirect_uri' => 'https://micronodes.tech/client/login.php',
    'code' => get('code')
  ));
  $logout_token = $token->access_token;
  $_SESSION['access_token'] = $token->access_token;


  header('Location: ' . $_SERVER['PHP_SELF']);
}

if(session('access_token')) {
  $user = apiRequest($apiURLBase);
 $_SESSION['user'] = $user;
 //--
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

 $sql = "SELECT * FROM points WHERE id='" . $user->id . "'";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 $sql2 = "UPDATE points SET logged=NOW() WHERE id='" . $user->id . "'";
 $result2 = $conn->query($sql2);

 if (!is_null($row['panel'])) {
 if (is_null($row['pass'])) {
    $username = generateRandomString(7);
    $pass = generateRandomString(16);
    $firstname = str_replace(" ","",substr($user->username,0,intval(strlen($user->username)/2)));
    $lastname = str_replace(" ","",substr($user->username,-intval(strlen($user->username)/2)));
    //
    $curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/users/" . $row['panel'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PATCH",
  CURLOPT_POSTFIELDS => '{"email": "' . $user->email . '","username": "' . $username . '","first_name":"' . $firstname . '","last_name": "' . $lastname . '","password": "' . $pass . '"}',
  CURLOPT_COOKIE => 'pterodactyl_session=eyJpdiI6InhIVXp5ZE43WlMxUU1NQ1pyNWRFa1E9PSIsInZhbHVlIjoiQTNpcE9JV3FlcmZ6Ym9vS0dBTmxXMGtST2xyTFJvVEM5NWVWbVFJSnV6S1dwcTVGWHBhZzdjMHpkN0RNdDVkQiIsIm1hYyI6IjAxYTI5NDY1OWMzNDJlZWU2OTc3ZDYxYzIyMzlhZTFiYWY1ZjgwMjAwZjY3MDU4ZDYwMzhjOTRmYjMzNDliN2YifQ%253D%253D',
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer 73ee6j0DQT38l1fWD6qGNZ6z3XaiyD4xldaeYdb1u3M59ZIF"
  )
));

$response = json_decode(curl_exec($curl));
$err = curl_error($curl);

$sql = "UPDATE points SET pass='" . $pass . "' WHERE id='" . $user->id . "'";
$result = $conn->query($sql);
if ($result == TRUE) header("Location: panel/");
else die("Error Occured");
 } else header("Location: panel/");
} else {
  if(!empty($row['panel']) && !empty($row['pass'])) header("Location: panel/");
  $username = generateRandomString(7);
  $pass = generateRandomString(16);
  $firstname = str_replace(" ","",substr($user->username,0,intval(strlen($user->username)/2)));
  $lastname = str_replace(" ","",substr($user->username,-intval(strlen($user->username)/2)));
  //
  $curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://gp.micronodes.tech/api/application/users",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => '{"email": "' . $user->email . '","username": "' . $username . '","first_name":"' . $firstname . '","last_name": "' . $lastname . '","password": "' . $pass . '"}',
CURLOPT_COOKIE => 'pterodactyl_session=eyJpdiI6InhIVXp5ZE43WlMxUU1NQ1pyNWRFa1E9PSIsInZhbHVlIjoiQTNpcE9JV3FlcmZ6Ym9vS0dBTmxXMGtST2xyTFJvVEM5NWVWbVFJSnV6S1dwcTVGWHBhZzdjMHpkN0RNdDVkQiIsIm1hYyI6IjAxYTI5NDY1OWMzNDJlZWU2OTc3ZDYxYzIyMzlhZTFiYWY1ZjgwMjAwZjY3MDU4ZDYwMzhjOTRmYjMzNDliN2YifQ%253D%253D',
CURLOPT_HTTPHEADER => array(
  "Accept: application/json",
  "Content-Type: application/json",
  "Authorization: Bearer 73ee6j0DQT38l1fWD6qGNZ6z3XaiyD4xldaeYdb1u3M59ZIF"
)
));

$response = json_decode(curl_exec($curl));
$err = curl_error($curl);
$sql = "INSERT INTO points(id,name,tag,points,ppd,panel,pass) VALUES('" . $user->id . "','" . $user->username . "','" . $user->discriminator . "','0','0','" . strval($response->attributes->id) . "','" . $pass . "')";
if ($result->num_rows > 0) $sql = "UPDATE points SET panel='" . strval($response->attributes->id) . "',pass='" . $pass . "' WHERE id='" . $user->id . "'";

$result = $conn->query($sql);
if ($result == TRUE) header("Location: panel/");
else die("Error Occured");
}
 //--

} else {
  header("Location: ./login.php?action=login");

}


if(get('action') == 'logout') {
  // This must to logout you, but it didn't worked(

  $params = array(
    'access_token' => $logout_token
  );

  // Redirect the user to Discord's revoke page
  header('Location: https://discord.com/api/oauth2/token/revoke' . '?' . http_build_query($params));
  die();
}

function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);


  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

  $headers[] = 'Accept: application/json';

  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  return json_decode($response);
}

function get($key, $default=NULL) {
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default=NULL) {
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
