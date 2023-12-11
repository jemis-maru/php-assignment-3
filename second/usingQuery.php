<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_all_products = "
  SELECT p.id AS product_id, p.name AS product_name, pa.attribute_name AS attribute_names, pa.attribute_values AS attribute_values
  FROM products p
  LEFT JOIN product_attributes pa ON p.id = pa.product_id
  WHERE (p.name LIKE 'Product%')
  GROUP BY p.id
  ORDER BY p.id;
";

$result = $conn->query($sql_all_products);

if ($result->num_rows > 0) {
  echo "Products and Attributes:<br />";
  while ($row = $result->fetch_assoc()) {
    echo "Product ID: " . $row["product_id"] . ", Name: " . $row["product_name"] . ", Attributes: " . $row["attribute_names"] . ", Attribute values: " . $row["attribute_values"] . "<br />";
  }
} else {
  echo "No products found.<br />";
}

$conn->close();

?>
