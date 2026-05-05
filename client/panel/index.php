<?php
session_start();

if (!isset($_SESSION['user'])) header("Location: ../");
$user = $_SESSION['user'];

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

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
    $points = $row['points'];
    $ppd = $row['ppd'];
    $panel = $row['panel'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gp.micronodes.tech/api/application/users/" . $panel . "?include=servers",
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


} else {
  $points = "0";
  $ppd = "0";
}
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Panel - MicroNodes</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
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
    <p class="text-center">Welcome, <b><?php echo $user->username; ?></b>!</p>
    <br>
    <center><hr class="bg-primary w-25"></center>

    <div class="row">
        <div class="col dashboard-card">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header"><?php echo sizeof(json_decode($response)->attributes->relationships->servers->data); ?></div>
                <div class="card-body">
                    <h5 class="card-title">Servers</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="col dashboard-card">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">
                <?php
                    $suspended = 0;
                    for ($i=0;$i<sizeof(json_decode($response)->attributes->relationships->servers->data);$i++) {
                        if (json_decode($response)->attributes->relationships->servers->data[$i]->attributes->suspended == true) {
                            $suspended++;
                        }
                    }
                    echo $suspended;
                    ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                   Suspended
                    </h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="col dashboard-card">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header" id="points"><?php echo $points; ?></div>
                <div class="card-body">
                    <h5 class="card-title">Points</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="col dashboard-card">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header"><?php echo $ppd; ?></div>
                <div class="card-body">
                    <h5 class="card-title">P/D</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>

    <center><hr class="bg-primary w-25"></center>
    <center>
<script src="//servedby.eleavers.com/ads/ads.php?t=MjMxOTY7MTQyNDg7aG9yaXpvbnRhbC5iYW5uZXI=&index=1"></script>
    <div class="row">
        <div class="col"><a href="create/" class="btn btn-info">Create Server</a></div>
        <div class="col"><a href="delete/" class="btn btn-info">Delete Server</a></div>
        <div class="col"><a  href="update/" class="btn btn-info">Upgrade Server</a></div>

    </div>
    </center>
    <center><hr class="bg-primary w-25"></center>
<center>
    <h3>Panel Login:</h3>
    <br>
        <?php 
        echo '<p>Username: <input id="username" value="' . json_decode($response)->attributes->username . '" onclick="copy(`username`)" class="form-control" style="width:25%" readonly></p>
        <p>Password: <input id="password" type="password" value="' . $row['pass'] . '" onclick="copy(`password`)" class="form-control" style="width:25%" readonly></p>';
        ?>
    <a class="btn btn-warning" href="https://gp.micronodes.tech">Control Panel</a>
<!--AppZilo Ads Start-->
<div id="azp_1006428" data-fid="4" class="azrocks azp_1006428"></div>
<!--AppZilo Ads End-->
<script src="//servedby.eleavers.com/ads/ads.php?t=MjMxOTY7MTQyNTM7aG9yaXpvbnRhbC5sZWFkZXJib2FyZA==&index=1"></script>
</center>
</div>
<script>
function copy (input) {
    if (input == "password") {
        if (document.getElementById(input).type == "password") document.getElementById(input).type = ""
        else document.getElementById(input).type = "password";
    }
    document.getElementById(input).select();
  document.getElementById(input).setSelectionRange(0, 99999); /* For mobile devices */
  document.execCommand("copy");
}
  </script>
  <script src="afk/points.js"></script>
  <script type="text/javascript" src="https://cdn.700tb.com/cbn.php?type=javascript&files=az.min.js"></script>

</body>
</html>
