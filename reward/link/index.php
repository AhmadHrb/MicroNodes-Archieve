<?php
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

session_start();
$servername = "localhost";
$username = "pterodactyl";
$password = "AH252938";
$dbname = "points";

if ($pageWasRefreshed) {
    header("Location: https://micronodes.tech/error/link.php");
} else {
    $redirectedPage = $_SERVER['HTTP_REFERER'];
    if ($redirectedPage == "https://shrinke.me/") {
$user = $_SESSION['user'];    
$id = $user->id;

if (!isset($_SESSION['user'])) header("Location: https://micronodes.tech/client");

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
header("https://micronodes.tech/client");
}

$sql = "SELECT *  FROM points WHERE id='" . $id . "'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
if (strtotime($row['shorten'])+43200 >= time()) {
    header("Location: https://micronodes.tech/error/time.php");
    die();
}
$newPoints = intval($row['points']) + 1000;

$sql = "UPDATE points SET points='" . strval($newPoints) . "', shorten=NOW() WHERE id='" . $row['id'] . "'";
$conn->query($sql);
$_SESSION['shrink'] = strtotime($date);
header("Location: https://micronodes.tech/reward");
} else {
header("Location: https://micronodes.tech/client");
}
$conn->close();

die();
    } else {
        header("Location: https://micronodes.tech/error/link.php");
    }
}
?>