<?php
session_start();
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: dashboard.php"); exit;
    }
    $msg = "Invalid username or password.";
}
?> 
<link rel="stylesheet" href="style.css">
<div class="card">
  <h2>Login</h2>
  <form method="POST">
    <input name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Login</button>
  </form>
  <p class="msg"><?= htmlspecialchars($msg) ?></p>
  <p style="text-align:center">No account? <a href="signup.php">Sign up</a></p>
</div> 
