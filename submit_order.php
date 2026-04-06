
<?php
$conn = mysqli_connect("localhost","root","","kureo_db4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$item = $_POST['item'];
$size= $_POST['size'];
$quantity = $_POST['quantity'];
$address = $_POST['address'];

$sql = "INSERT INTO orders (name, email, phone, item, quantity,size, address)
VALUES ('$name', '$email', '$phone', '$item', '$quantity','$size', '$address')";

if ($conn->query($sql) === TRUE) {
    header("Location: done.html");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
