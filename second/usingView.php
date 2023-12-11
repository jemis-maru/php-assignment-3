<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_create_view = "
  CREATE OR REPLACE VIEW product_view AS
  SELECT p.id AS product_id, p.name AS product_name, pa.attribute_name AS attribute_names, pa.attribute_values AS attribute_values
  FROM products p
  LEFT JOIN product_attributes pa ON p.id = pa.product_id
  WHERE (p.name LIKE 'Product%')
  GROUP BY p.id
  ORDER BY p.id;
";

if ($conn->query($sql_create_view) === TRUE) {
  echo "View created successfully.<br />";
} else {
  echo "Error while creating view: " . $conn->error . "<br />";
}

$sql_select_from_view = "SELECT * FROM product_view";

$result = $conn->query($sql_select_from_view);

if ($result->num_rows > 0) {
  echo "Records using the view:<br />";
  while ($row = $result->fetch_assoc()) {
    echo "Product ID: " . $row["product_id"] . ", Name: " . $row["product_name"] . ", Attributes: " . $row["attribute_names"] . ", Attribute values: " . $row["attribute_values"] . "<br />";
  }
} else {
  echo "No records found.<br />";
}

$conn->close();
