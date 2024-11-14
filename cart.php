<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][] = $product_id;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Your Shopping Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $product_id) {
                    // Fetch product details from the database
                    $sql = "SELECT * FROM products WHERE product_id = $product_id";
                    $result = $conn->query($sql);
                    $product = $result->fetch_assoc();
                    $total += $product['price'];
                    echo "<tr>
                            <td>{$product['product_name']}</td>
                            <td>${$product['price']}</td>
                            <td>1</td>
                          </tr>";
                }
                ?>
                <tr>
                    <td colspan="2">Total</td>
                    <td>$<?php echo $total; ?></td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-success">Checkout</button>
    </div>
</body>
</html>
