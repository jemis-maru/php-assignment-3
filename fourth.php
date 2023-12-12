<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_get_categories_with_stock = "
  SELECT c.id, c.name, COUNT(cp.product_id) AS product_count
  FROM categories c
  JOIN category_products cp ON c.id = cp.category_id
  JOIN products p ON cp.product_id = p.id
  WHERE p.stock > 0
  GROUP BY c.id;
";

$result = $conn->query($sql_get_categories_with_stock);

if ($result->num_rows > 0) {
  echo "Categories with Product Stock Greater Than Zero:<br />";
  while ($row = $result->fetch_assoc()) {
    echo "Category ID: " . $row["id"] . ", Name: " . $row["name"] . ", Product Count: " . $row["product_count"] . "<br />";
  }
} else {
  echo "No categories found with product stock greater than zero.<br />";
}

$conn->close();

?>
