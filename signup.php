<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO users (username,email,fullname,password) VALUES (?,?,?,?)");
    try {
        $stmt->execute([$_POST['username'], $_POST['email'], $_POST['fullname'],
            password_hash($_POST['password'], PASSWORD_DEFAULT)]);
        $msg = "Registered successfully!";
    } catch (PDOException $e) { $msg = "Username already exists."; }
}
?> 
[200~<link rel="stylesheet" href="style.css">
<div class="card">
  <h2>Sign Up</h2>
  <form method="POST">
    <input name="username" placeholder="Username" required>
    <input name="fullname" placeholder="Full name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Sign up</button>
  </form>
  <p class="msg"><?= htmlspecialchars($msg) ?></p>
  <p style="text-align:center">Have an account? <a href="login.php">Login</a></p>
</div>
