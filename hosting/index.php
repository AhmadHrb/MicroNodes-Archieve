<?php
 $servername = "localhost";
 $username = "pterodactyl";
 $password = "AH252938";
 $dbname = "panel";
 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }

 ?>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Server Hosting - MicroNodes</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    </head>
    <body>
     <?php require('../nav.php'); ?>
     <div class="container-fluid bg-primary">
     <div class="row">
     <div class="col text-light text-center">
     <br><br><br><br>
        <h1>Server Hosting</h1>
        <a href="" class="typewrite text-light" data-period="2000" data-type='[ "Minecraft Servers", "AmongUs Servers", "Discord Bots", "Rust Servers", "Database Hosting", "Storage", "CSGO Servers", "ARK Servers", "VoIP Servers", "and more.." ]'></a>
        <span class="wrap"></span>
        </div>
        <div class="col page-icon">
        <img style="width:240px;height:240px;border-radius: 50%" src="../img/icons/minecraft.png" id="icon">
        </div>
        </div>

</div>
<!-- Minecraft Java -->
<hr class="bg-dark">
<center>

<p>This is a randomly generated list of servers hosted here!</p>
<br>
<h2 style="font-family: Roboto">Minecraft Java:</h2>
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
 
<?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://gp.micronodes.tech/api/application/nests/1?include=servers",
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
        
        $response = json_decode(curl_exec($curl));
        $err = curl_error($curl);
            $numberOfServers = 0;
            while(true) {
                if ($numberOfServers == 5) break;
                $rnd[$numberOfServers] = rand(0,sizeof($response->attributes->relationships->servers->data));
                if ($response->attributes->relationships->servers->data[$numberOfServers]->attributes->suspended !== 1) {
                $numberOfServers++;
                }
            }
            for ($i=0;$i<sizeof($rnd);$i++) {
                $nb = $rnd[$i];
            $allocation = $response->attributes->relationships->servers->data[$nb]->attributes->allocation;

 $sql = "SELECT * FROM allocations WHERE id=" . $allocation;
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 echo '<li class="list-group-item">' . $response->attributes->relationships->servers->data[$nb]->attributes->name . ' ' . $row['ip_alias'] . ':' . $row['port'] . '</li>';
            }

        curl_close($curl);
        ?>
 </ul>
</div>
</center>

<!-- Minecraft Bedrock -->

<hr class="bg-dark">
<center>
<h2 style="font-family: Roboto">Minecraft Bedrock:</h2>
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
 
<?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://gp.micronodes.tech/api/application/nests/6?include=servers",
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
        
        $response = json_decode(curl_exec($curl));
        $err = curl_error($curl);
            $numberOfServers = 0;
            while(true) {
                if ($numberOfServers == 5) break;
                $rnd[$numberOfServers] = rand(0,sizeof($response->attributes->relationships->servers->data));
                if ($response->attributes->relationships->servers->data[$numberOfServers]->attributes->suspended !== 1) {
                $numberOfServers++;
                }
            }
            for ($i=0;$i<sizeof($rnd);$i++) {
                $nb = $rnd[$i];
            $allocation = $response->attributes->relationships->servers->data[$nb]->attributes->allocation;

 $sql = "SELECT * FROM allocations WHERE id=" . $allocation;
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 echo '<li class="list-group-item">' . $response->attributes->relationships->servers->data[$nb]->attributes->name . ' ' . $row['ip_alias'] . ':' . $row['port'] . '</li>';
            }

        curl_close($curl);
        ?>
 </ul>
</div>
</center>

<!-- -->
<hr class="bg-dark">
                    <center>
                        <h3><b>Need Help?</b></h3>
                        <div class="container">
                        <div class="row">
                            <div class="col text-primary"><a href="../discord/" style="color:unset"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50%;height: 100%" fill="currentColor" class="bi bi-discord" viewBox="0 0 16 16">
                                <path d="M6.552 6.712c-.456 0-.816.4-.816.888s.368.888.816.888c.456 0 .816-.4.816-.888.008-.488-.36-.888-.816-.888zm2.92 0c-.456 0-.816.4-.816.888s.368.888.816.888c.456 0 .816-.4.816-.888s-.36-.888-.816-.888z"/>
                                <path d="M13.36 0H2.64C1.736 0 1 .736 1 1.648v10.816c0 .912.736 1.648 1.64 1.648h9.072l-.424-1.48 1.024.952.968.896L15 16V1.648C15 .736 14.264 0 13.36 0zm-3.088 10.448s-.288-.344-.528-.648c1.048-.296 1.448-.952 1.448-.952-.328.216-.64.368-.92.472-.4.168-.784.28-1.16.344a5.604 5.604 0 0 1-2.072-.008 6.716 6.716 0 0 1-1.176-.344 4.688 4.688 0 0 1-.584-.272c-.024-.016-.048-.024-.072-.04-.016-.008-.024-.016-.032-.024-.144-.08-.224-.136-.224-.136s.384.64 1.4.944c-.24.304-.536.664-.536.664-1.768-.056-2.44-1.216-2.44-1.216 0-2.576 1.152-4.664 1.152-4.664 1.152-.864 2.248-.84 2.248-.84l.08.096c-1.44.416-2.104 1.048-2.104 1.048s.176-.096.472-.232c.856-.376 1.536-.48 1.816-.504.048-.008.088-.016.136-.016a6.521 6.521 0 0 1 4.024.752s-.632-.6-1.992-1.016l.112-.128s1.096-.024 2.248.84c0 0 1.152 2.088 1.152 4.664 0 0-.68 1.16-2.448 1.216z"/>
                            </svg></a></div>
                            <div class="col text-warning"><a href="mailto:support@micronodes.tech" style="color: unset"><svg xmlns="http://www.w3.org/2000/svg" style="width: 50%;height: 100%" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                            </svg></a></div>
                        </div>
                        </div>
                    </center>

                    <hr class="bg-dark">
                    <center>
                        <div class="bg-primary">

                            <br>
                            <p>&copy; 2021 - <b class="rainbow">MicroNodes</b>.</p>
                            <br>
                        </div>
                    </center>

          <script src="../js/jquery.js"></script>
          <script src="../js/bootstrap.js"></script>
          <script>
          var images = [];
images[0] = "../img/icons/minecraft.png";
images[1] = "../img/icons/amongus.png";
images[2] = "../img/icons/discord.png";
images[3] = "../img/icons/rust.png";
images[4] = "../img/icons/mongodb.png";
images[5] = "../img/icons/minio.png";
images[6] = "../img/icons/csgo.png";
images[7] = "../img/icons/ark.png";
images[8] = "../img/icons/mumble.png";
images[9] = "../img/logo.png";
    let lastOne = 0;
          var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';
        if (lastOne !== i) {
        $('#icon').fadeOut(200, function(){
        $(this).attr('src', images[i]).fadeIn(200);
    })
        lastOne = i;
        }
        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
    
          </script>
    </body>
</html>