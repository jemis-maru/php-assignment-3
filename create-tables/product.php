<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_create_table = "CREATE TABLE products (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price FLOAT(8, 2) NOT NULL,
  image VARCHAR(255),
  stock INT(11) NOT NULL,
  status BOOLEAN NOT NULL,
  INDEX product_name_index (name)
)";

if ($conn->query($sql_create_table) === TRUE) {
  echo "Table created successfully<br />";
} else {
  echo "Error while creating table: " . $conn->error . "<br />";
}

$sql_seed_data = "INSERT INTO products (name, price, image, stock, status) VALUES
                  ('Test', 9.5, 'test.jpg', 50, 0),
                  ('Product 1', 10, 'product1.jpg', 100, 1),
                  ('Product 2', 11, 'product2.jpg', 50, 1),
                  ('Product 3', 12.51, 'product3.jpg', 75, 0),
                  ('Product 4', 13, 'product4.jpg', 120, 1)";

if ($conn->query($sql_seed_data) === TRUE) {
  echo "Data inserted successfully<br />";
} else {
  echo "Error while inserting data: " . $conn->error . "<br />";
}

$conn->close();

?>
