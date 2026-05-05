<?php

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

$sql = "SELECT * FROM links WHERE id='" . $_GET['id'] . "'";
$result = $conn->query($sql);
if ($result->num_rows == 0) header("Location: ../");
$row = $result->fetch_assoc();
$newTaffic = intval($row['traffic']) + 1;
$sql = "UPDATE links SET traffic=" . $newTaffic . " WHERE id=" . $row['id'];
$result = $conn->query($sql);
header("Location: https://" . $row['link']);
die("Redirecting to <a href='https://" . $row['link'] . "'>https://" . $row['link'] . "</a>");
?>