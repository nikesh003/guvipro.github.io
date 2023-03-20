
<?php
$dbHost = 'localhost';
$dbName = 'nik_guvi';
$dbUser = 'root';
$dbPass = '';

$f_name     = filter_input(INPUT_POST, 'f_name', FILTER_SANITIZE_STRING);
$l_name     = filter_input(INPUT_POST, 'l_name', FILTER_SANITIZE_STRING);
$x_mail    = filter_input(INPUT_POST, 'x_mail', FILTER_SANITIZE_EMAIL);
$c_pass = filter_input(INPUT_POST, 'c_pass', FILTER_SANITIZE_STRING);

try {
  $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $db->prepare("INSERT INTO tab_guvi (f_name,l_name, x_mail, c_pass) VALUES (:f_name,:l_name, :x_mail, :c_pass)");
  $stmt->bindParam(':f_name', $f_name);
  $stmt->bindParam(':l_name', $l_name);
  $stmt->bindParam(':x_mail', $x_mail);
  $stmt->bindParam(':c_pass', $c_pass);
  $stmt->execute();

  echo json_encode(array('success' => true));
} catch(PDOException $e) {
  echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>
