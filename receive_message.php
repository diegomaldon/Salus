<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "esp32_data";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$user = $data["user"];
$location = $data["location"];
$message = $data["message"];

if ($message) {
  $stmt = $conn->prepare("INSERT INTO messages (message) VALUES (?)");
  $stmt->bind_param("s", $message);
  $stmt->execute();
  echo "Message received and stored.";
  $stmt->close();
} else {
  echo "No message received.";
}

$conn->close();
?>