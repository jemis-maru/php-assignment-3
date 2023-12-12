<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_create_table = "CREATE TABLE product_attributes (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  product_id INT(6) UNSIGNED,
  attribute_name VARCHAR(255) NOT NULL,
  attribute_values TEXT,
  FOREIGN KEY (product_id) REFERENCES products(id),
  INDEX attribute_name_index (attribute_name)
)";

if ($conn->query($sql_create_table) === TRUE) {
  echo "Table created successfully<br />";

  $sql_seed_data = "INSERT INTO product_attributes (product_id, attribute_name, attribute_values) VALUES
                    (1, 'Color', '[\"Black\", \"White\", \"Yellow\"]'),
                    (2, 'Size', '[\"SM\", \"MD\", \"LG\"]'),
                    (1, 'Weight', '[\"1kg\", \"2kg\", \"3kg\"]'),
                    (3, 'Material', '[\"Cotton\", \"Polyester\"]')";
  
  if ($conn->query($sql_seed_data) === TRUE) {
    echo "Data inserted successfully<br />";
  } else {
    echo "Error while inserting data: " . $conn->error . "<br />";
  }
} else {
  echo "Error while creating table: " . $conn->error . "<br />";
}

$conn->close();

?>
