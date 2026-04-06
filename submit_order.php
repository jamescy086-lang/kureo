<?php
$conn = mysqli_connect("https://kureo.infinityfreeapp.com", "your_db_user", "your_db_pass", "kureo_db4");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// --- GET FORM DATA ---
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$item = $_POST['item'] ?? '';
$size = $_POST['size'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$address = $_POST['address'] ?? '';

// --- VALIDATION ---
if(empty($name) || empty($email) || empty($item) || empty($quantity)) {
    die("Please fill all required fields.");
}

// --- INSERT ORDER USING PREPARED STATEMENT ---
$stmt = $conn->prepare(
    "INSERT INTO orders (name, email, phone, item, quantity, size, address) 
    VALUES (?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("ssssiss", $name, $email, $phone, $item, $quantity, $size, $address);

if($stmt->execute()) {
    // Redirect to a thank you page
    header("Location: done.html");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
