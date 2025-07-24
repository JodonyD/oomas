<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $order = htmlspecialchars(trim($_POST['order']));

    $sql = "INSERT INTO orders (fname, lname, order_description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $fname, $lname, $order);

    if ($stmt->execute()) {
        echo "<script>alert('Order placed successfully!'); window.location.href='order.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
