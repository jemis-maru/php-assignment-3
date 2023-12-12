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
  CREATE TABLE categories (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    status BOOLEAN,
    INDEX name_index (name)
  )
";

if ($conn->query($sql_create_table) === TRUE) {
  echo "Table created successfully<br />";

  $sql_seed_data = "INSERT INTO categories (name, status) VALUES
                      ('Category A', 1),
                      ('Category B', 1),
                      ('Category C', 0),
                      ('Category D', 1)
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
