<?php
$dbHost = 'localhost';
$dbName = 'nik_guvi';
$dbUser = 'root';
$dbPass = '';

$x_mail    = filter_input(INPUT_POST, 'x_mail', FILTER_SANITIZE_EMAIL);
$c_pass = filter_input(INPUT_POST, 'c_pass', FILTER_SANITIZE_STRING);

try {
  $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $db->prepare("SELECT x_mail,c_pass FROM tab_guvi WHERE x_mail=:x_mail AND c_pass=:c_pass");
  $stmt->bindParam(':x_mail', $x_mail);
  $stmt->bindParam(':c_pass', $c_pass);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if($user) {
    echo json_encode(array('success' => true));
  } else {
    echo json_encode(array('success' => false, 'error' => 'Invalid email or password'));
  }
} catch(PDOException $e) {
  echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>