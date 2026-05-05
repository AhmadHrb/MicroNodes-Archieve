<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Apply - MicroNodes</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>
    <body>
    <?php require('../nav.php'); ?>
                    <center>
                    <h2 class="rainbow">Volunteer Application:</h2>
                    <br>
                    <?php
                    if (isset($_GET['err'])) {
                        if ($_GET['err'] == "captcha") {
                            echo '<div class="alert alert-danger w-25" role="alert">You didnt solve the captcha!</div>';
                        } else if ($_GET['err'] == "db") {
                            echo '<div class="alert alert-danger w-25" role="alert">Something occured, Contact Support!</div>';

                        } else if ($_GET['err'] == "questions") {
                            echo '<div class="alert alert-danger w-25" role="alert">You didnt answer all the questions!</div>';

                        }
                    } else if (isset($_GET['success'])) {
                        if ($_GET['success'] == "true") {
                            echo '<div class="alert alert-success w-25" role="alert">Application Sent!</div>';

                        }
                    }
                    ?>
                    <form method="post" action="apply.php">
                    <div class="container">
                    <p>Name:<br><input class="form-control w-50" name="name"></p>
                    <p>Timezone:<br><input class="form-control w-50" name="time"></p>
                    <p>Age:<br><input class="form-control w-50" name="age"></p>
                    <p>Email:<br><input class="form-control w-50" name="email"></p>
                    <p>Discord Tag:<br><input class="form-control w-50" name="discord"></p>
                    <p>Languages:<br><input class="form-control w-50" name="langs"></p>
                    <p>Apply as:<br><select id="team" class="text-center form-control w-50" onchange="changeQuestions()" name="role"><option value="-1">Select One</option><option value="0">Community Team</option><option value="1">Support Team</option><option value="2">Development Team</option></select></p>
                    <div id="team-questions">

                    </div>
                    <div id="finish" hidden="true" class="w-25">
                    
                    <label class="form-check-label" for="flexCheckDefault"><small>
                    You will be paid 9,000 Points every week
                    </small></label>
                    </div>
                    <br>
                    <div class="g-recaptcha" data-sitekey="6Lc7Fl8aAAAAAJOO1fRrPiNXW6P3ST1_CKCZbiHh"></div>

                    <br>
                    <button class="btn btn-success">Send</button>
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
          function changeQuestions() {
            let team = document.getElementById('team').value;
            if (team == "-1") {
                document.getElementById('team-questions').innerHTML = "";

                document.getElementById("finish").hidden = true;
return;
            } else if (team == "0") {
                document.getElementById('team-questions').innerHTML = '<p>Why do you want to become a Moderator at MicroNodes?<br><textarea class="form-control w-50" name="q1"></textarea></p><p>Do you know how to use Discord?<br><textarea class="form-control w-50" name="q2"></textarea></p><p>Do you know how to use Discord Bots?<br><textarea class="form-control w-50" name="q3"></textarea></p><p>How active will you be on Discord?<br><textarea class="form-control w-50" name="q4"></textarea></p><p>Do you know how to use Email?<br><textarea class="form-control w-50" name="q5"></textarea></p><p>What makes you the best for this role?<br><textarea class="form-control w-50" name="q6"></textarea></p>';
            } else if (team == "1") {

                document.getElementById('team-questions').innerHTML = '<p>Why do you want to become a support member?<br><textarea class="form-control w-50" name="q1"></textarea></p><p>What server software are you most experienced in?<br><textarea class="form-control w-50" name="q2"></textarea></p><p>What will you bring to MicroNodes?<br><textarea class="form-control w-50" name="q3"></textarea></p><p>What makes you the best for this role?<br><textarea class="form-control w-50" name="q4"></textarea></p><p>How active will you be?<br><textarea class="form-control w-50" name="q5"></textarea></p><p>What experience do you have in Pterodactyl Panel?<br><textarea class="form-control w-50" name="q6"></textarea></p>';

            } else if (team == "2") {

                document.getElementById('team-questions').innerHTML = '<p>What languages do you know?<br><textarea class="form-control w-50" name="q1"></textarea></p><p>What server software are you experienved in?<br><textarea class="form-control w-50" name="q2"></textarea></p><p>Do you have experience in the Pterodactyl Panel?<br><textarea class="form-control w-50" name="q3"></textarea></p><p>Can you develop plugins?<br><textarea class="form-control w-50" name="q4"></textarea></p><p>How much do you code daily?<br><textarea class="form-control w-50" name="q5"></textarea></p><p>How active will you be?<br><textarea class="form-control w-50" name="q6"></textarea></p>';
            }
            document.getElementById("finish").hidden = false;
           }
          </script>
    </body>
</html>