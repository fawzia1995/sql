<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Insert into users table
    $conn = new mysqli('localhost', 'root', '', 'online_store');
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- HTML Form for Registration -->
<form method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Register</button>
</form>
