<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hosting Plans - MicroNodes</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body class="bg-light">
    
     <?php require('../nav.php'); ?>
     <div class="container">
         <center>
     <h1>Plans:</h1>
     <br>
     <p>For Custom Plans or additional resources, <a href="../#help">Contact Us</a></p>
     <div class="pricing">
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
 $sql = "SELECT * FROM plans";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['disk'] == "0") $disk = "Unlimited";
        else $disk = $row['disk'] . " MB";
    echo '<div class="columns">
    <ul class="price">
      <li class="header">' . $row['name'] . '</li>
      <li class="grey">' . $row['points'] . ' Points / day</li>
      <li>' . $row['cpu'] . '% CPU</li>
      <li>' . $row['ram'] . 'MB RAM</li>
      <li>' . $disk . ' Storage</li>
      <li>1 Port</li>
      <li class="grey"><a href="https://micronodes.tech/client" class="btn btn-info">Sign Up</a></li>
    </ul>
  </div>';
    }
    
  }
?>
</div>
        </center>
        </div>

          <script src="../js/jquery.js"></script>
          <script src="../js/bootstrap.js"></script>
          <script src="../js/script.js"></script>
    </body>
</html>