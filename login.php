<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple validation and authentication
    // Note: In a production environment, you would use password hashing (e.g., password_hash())
    $conn = new mysqli('localhost', 'root', '', 'online_store');
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $result->fetch_assoc();
        header('Location: index.php');
    } else {
        $error = 'Invalid credentials';
    }
}
?>

<!-- HTML Form for Login -->
<form method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
</form>
