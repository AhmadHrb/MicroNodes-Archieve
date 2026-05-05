<?php

session_start();
$servername = "localhost";
$username = "pterodactyl";
$password = "AH252938";
$dbname = "points";

$name = $_SESSION['user']->username;
$tag = $_SESSION['user']->discriminator;
$id = $_SESSION['user']->id;

if (!isset($name) || !isset($tag) || !isset($id)) die("Please Login");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT *  FROM points WHERE id='" . $id . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$newPoints = intval($row['points']) + 3;
if (strtotime($row['time'])+5 >= time()) die("You cant afk on 2+ devices!");

$sql = "UPDATE points SET points='" . strval($newPoints) . "', time=NOW() WHERE id='" . $row['id'] . "'";
if ($conn->query($sql) === TRUE) echo $newPoints;
else echo "Error Occured";  
} else {
$sql = "INSERT INTO points (id,name, tag, points) VALUES ('" . $id . "','" . $name . "','" . $tag . "', '10')";
  if ($conn->query($sql) == TRUE) echo "10";
else echo "Error Occured!";
}
$conn->close();
?>
