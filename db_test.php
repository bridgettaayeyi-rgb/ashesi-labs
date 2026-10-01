<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>Database Connection Test</h3>";

define("SERVER", "localhost");
define("USERNAME", "bridgetta.akoto");
define("PASSWD", "YOUR_NEW_PASSWORD_HERE");   // ← put the new password
define("DATABASE", "ecommerce_2026A_bridgetta_akoto");

echo "Trying to connect...<br>";
echo "Server: " . SERVER . "<br>";
echo "Username: " . USERNAME . "<br>";
echo "Database: " . DATABASE . "<br><br>";

$conn = @new mysqli(SERVER, USERNAME, PASSWD, DATABASE);

if ($conn->connect_error) {
    echo "<p style='color:red;'><strong>FAILED</strong></p>";
    echo "Error: " . $conn->connect_error;
} else {
    echo "<p style='color:green;'><strong>SUCCESS!</strong> Connected to the database.</p>";
    $conn->close();
}
?>