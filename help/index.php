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

$sql = "SELECT * FROM help ORDER BY RAND() LIMIT 3";
$result = $conn->query($sql);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Help Center - MicroNodes</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
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
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
  <a class="navbar-brand" href="https://micronodes.tech"><b>MicroNodes</b></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="https://micronodes.tech/help">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://micronodes.tech/discord">Discord</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mailto:support@micronodes.tech">Email</a>
      </li>
    </ul>
  </div>
</div>
</nav>
<br><br>
<div class="container">
<center>
<h1 style="font-family: Noto Sans">Help Center</h1>
<br>
<form method="get" action="question/">
<input class="form-control w-75" name="q" style="border-radius: 25px" placeholder="How can we help you?">

<br><br>
<button class="btn btn-outline-dark">Search</button>
</form>
<hr class="bg-dark">
<div style="border:1px solid black">
<div class="row">
<div class="col">
<?php
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<br>";
    echo "<a href='question/" . $row['page'] . "'>" . $row['name'] . "</a>";
    echo "<br>";
  }
}
?>
</div>
<div class="col">
<div class="text-warning"><a href="mailto:support@micronodes.tech" style="color: unset"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50%;height: 100%" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/></svg></a></div>
</div>
</div>
</center>
</div>
</body>
</html>