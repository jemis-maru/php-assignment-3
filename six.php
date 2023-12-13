<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database_assignment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_create_trigger = "
  CREATE TRIGGER before_delete_product
  BEFORE DELETE ON products
  FOR EACH ROW
  BEGIN
    DELETE FROM category_products WHERE product_id = OLD.id;
    DELETE FROM product_attributes WHERE product_id = OLD.id;
  END
";

$conn->query($sql_create_trigger);

echo "Trigger created successfully.<br />";

$conn->close();

?>
