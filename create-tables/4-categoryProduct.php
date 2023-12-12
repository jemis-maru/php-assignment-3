<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_create_table = "
  CREATE TABLE category_products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id INT(6) UNSIGNED,
    product_id INT(6) UNSIGNED,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
  )
";

if ($conn->query($sql_create_table) === TRUE) {
  echo "Table created successfully<br />";

  $sql_seed_data = "INSERT INTO category_products (category_id, product_id) VALUES
                        (1, 1),
                        (1, 2),
                        (2, 3),
                        (2, 4),
                        (3, 5),
                        (4, 1)
                    ";

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
