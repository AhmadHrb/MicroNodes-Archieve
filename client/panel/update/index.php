<?php
session_start();
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

$user = $_SESSION['user']->id;

$sql = "SELECT * FROM plans";
$plans = $conn->query($sql);

$sql = "SELECT * FROM points WHERE id='" . $user . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!isset($_SESSION['user'])) header("Location: ../../");
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
    "Authorization: Bearer 1juhX2HMupgHfw8VG04tyHnMUTEvzLunLCGYb3WaHoVtWUFP"
  )
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upgrade Server - MicroNodes</title>
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/style.css">
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
    <script async src="https://arc.io/widget.min.js#k3b1mXCP"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JMEDL5HTLD"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "G-JMEDL5HTLD");
</script>
    <script data-ad-client="ca-pub-5589791863811603" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body class="bg-primary">
<div class="bg-light dashboard">
    <h1 class="rainbow text-center"><b>MicroNodes</b></h1>
    <p class="text-center">Upgrade a Server</p>
    <center>
    <script src="//servedby.eleavers.com/ads/ads.php?t=MjMxOTY7MTQyNDg7aG9yaXpvbnRhbC5iYW5uZXI=&index=1"></script>

    <?php 
    if ($_GET['err']) {
      if ($_GET['err'] == "points") {
        echo "<div class='alert alert-danger w-25'>You don't have enough points!</div>";
      } else if ($_GET['err'] == "captcha") {
        echo "<div class='alert alert-danger w-25'>You didn't solve the captcha!</div>";

      }
    } else if ($_GET['success'] == "true") {
      echo "<div class='alert alert-success w-25'>Server Upgraded Successfully!</div>";
    }
    ?>
        <hr class="bg-primary w-25">
        <p>Server:</p>
	<form method="post" action="update.php">
    <select name="server">
	<?php
  
	for($i=0;$i<sizeof(json_decode($response)->attributes->relationships->servers->data);$i++) {
	echo "<option value='" . json_decode($response)->attributes->relationships->servers->data[$i]->attributes->id . "'>" . json_decode($response)->attributes->relationships->servers->data[$i]->attributes->name . "</option>";
}
if (sizeof(json_decode($response)->attributes->relationships->servers->data) == 0) {
  header("Location: ../");
}
	?> 
</select>
<br><br>
        <p>Hosting Plan:</p>
        <select name="plan">
        <?php
	while($row = $plans->fetch_assoc()) {
    echo "<option value='" . $row['name'] . "'>" . $row['name'] . " - " . $row['points'] . " Points / Day </option>";
  }
	?>
	</select>
        <br><br>
        <div class="h-captcha" data-sitekey="ed2c61e2-9bf3-45c6-8ba9-7d04198bf94c"></div>

        <a class="btn btn-danger" href="../">Back</a>
        <button class="btn btn-info">Upgrade Server</button><br>
        <script src="//servedby.eleavers.com/ads/ads.php?t=MjMxOTY7MTQyNDg7aG9yaXpvbnRhbC5iYW5uZXI=&index=1"></script>

	</form>
    </center>
</div>
</body>
</html>
