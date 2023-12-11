<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_create_procedure = "
  CREATE PROCEDURE GetProducts(
    IN status_param BOOLEAN,
    IN order_column VARCHAR(255),
    IN order_direction VARCHAR(4),
    IN limit_param INT
  )
  BEGIN
    SET @query = CONCAT('
      SELECT * FROM products 
      WHERE status = ', status_param, '
      ORDER BY ', order_column, ' ', order_direction, '
      LIMIT ', limit_param
    );
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
  END;
";

if ($conn->multi_query($sql_create_procedure) === TRUE) {
  echo "Stored procedure created successfully<br />";
} else {
  echo "Error while creating stored procedure: " . $conn->error . "<br />";
}

// get data using stored procedure
$status_param = 1;
$order_column = 'price';
$order_direction = 'DESC';
$limit_param = 5;

$sql_call_procedure = "CALL GetProducts($status_param, '$order_column', '$order_direction', $limit_param)";

$result = $conn->query($sql_call_procedure);

if ($result->num_rows > 0) {
  echo "Product (from stored procedure):<br />";
  while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row["id"] . ", Name: " . $row["name"] . ", Price: $" . $row["price"] . "<br />";
  }
} else {
  echo "No products found.<br />";
}

$conn->close();

?>
