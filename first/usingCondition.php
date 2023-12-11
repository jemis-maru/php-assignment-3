<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_select_query = "SELECT * FROM products WHERE status = 1 ORDER BY price DESC LIMIT 5";

$result = $conn->query($sql_select_query);

if ($result->num_rows > 0) {
  echo "Product records:<br />";
  while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row["id"] . ", Name: " . $row["name"] . ", Price: $" . $row["price"] . "<br />";
  }
} else {
  echo "No products found.<br />";
}

$conn->close();

?>