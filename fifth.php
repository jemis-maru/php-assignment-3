<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$position = 3;

$sql_get_third_highest_price = "
  SELECT DISTINCT price, name
  FROM products
  ORDER BY price DESC
  LIMIT 1 OFFSET " . $position - 1 . ";";

$result = $conn->query($sql_get_third_highest_price);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo "Price of " . $row["name"] . " is: " . $row["price"] . "\n";
} else {
  echo "No products found.\n";
}

$conn->close();

?>
