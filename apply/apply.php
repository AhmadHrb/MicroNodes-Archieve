<?php
$token = $_POST['g-recaptcha-response'];
$secret = "6Lc7Fl8aAAAAAD1RGdNZ9bTNno_bJoIj-CvPpMdu";
$post_data = 
[
    'secret' => $secret,
    'response' => $_POST['g-recaptcha-response']
];

$response = apiRequest("https://www.google.com/recaptcha/api/siteverify",$post_data);

$json = json_decode($response);

if ($json->success) {
  
    if (!$_POST['name'] || !$_POST['time'] || !$_POST['age'] || !$_POST['email'] || !$_POST['discord'] || !$_POST['langs'] || !$_POST['q1'] || !$_POST['q2'] || !$_POST['q3'] || !$_POST['q4'] || !$_POST['q5'] || !$_POST['q6']) return header("Location: ./?err=questions");
   
$json_data = [
    "content" => "Timezone: " . $_POST['time'] . "\nAge: " . $_POST['age'] . "\nEmail: " . $_POST['email'] . "\nDiscord Tag: " . $_POST['discord'] . "\nLangauges: " . $_POST['langs'] . "Role: " . $_POST['role'] . "\nQ1: " . $_POST['q1'] . "\nQ2: " . $_POST['q2'] . "\nQ3: " . $_POST['q3'] . "\nQ4: " . $_POST['q4'] . "\nQ5: " . $_POST['q5'] . "\nQ6: " . $_POST['q6'],
    "username" => $_POST['name'],
];
apiRequest("https://discord.com/api/webhooks/812376873630826506/6s9rwh5QEQZW1Sz4ws3JjIKdkRfWDpk5kSTdIEf5cX7xqj6cIUShNqbjjBdBI1cCetBT",$json_data);
      header("Location: ./?success=true");
   
    
    $conn->close();
    //--
} else {
    header("Location: ./?err=captcha");
}





function apiRequest($url, $post=FALSE, $headers=array()) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  
    $response = curl_exec($ch);
  
  
    if($post)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  
    $headers[] = 'Accept: application/json';
  
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
    $response = curl_exec($ch);
    return $response;
  }
?>