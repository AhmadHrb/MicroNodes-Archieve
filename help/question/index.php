<?php
if (!isset($_GET['q'])) header("Location: ../");
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

$sql = "SELECT * FROM help";
$result = $conn->query($sql);
$query = $_GET['q'];
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $query; ?> - MicroNodes Help</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    </head>
    <body>
    <?php require("nav.php"); ?>
    <div class="container bg-light">
    <center>
    <h2 style="font-family: Noto Sans"><?php echo $query; ?>:</h2>
    </center>
    <br>
    <br>
    <center>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

    if(preg_match("/{$query}/i", $row['name']) || strpos($row['name'], $query)) {
        echo "<a href='../question/" . $row['page'] . "'>" . $row['name'] . "</a><br><br>";
    }
}
} else {
  echo "<p>No Answers found for your question.</p>";
  echo "<p>Please, <a href='https://micronodes.tech#help'>Contact Us</a> Instead!</p>";
}
?>

    
<br><br>
    <p>&copy; 2021 - MicroNodes</p>
    </center>
    </div>
    </body>
    </html>