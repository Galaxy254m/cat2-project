<?php
session_start();
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO feedback (name,email,message) VALUES (?,?,?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['message']]);
    $msg = "Thank you! Your feedback was saved.";
}
$rows = $pdo->query("SELECT * FROM feedback ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?> 
<link rel="stylesheet" href="style.css">
<style>
  body{align-items:flex-start;padding:30px 0}
  .card.wide{width:720px;max-width:95%}
  table{width:100%;border-collapse:collapse;margin-top:15px;font-size:14px}
  th,td{border:1px solid #ccc;padding:8px;text-align:left}
  th{background:#1f2a44;color:#fff}
</style> 
<div class="card wide">
  <h2>Feedback Form</h2>
  <form method="POST">
    <input name="name" placeholder="Your name" required>
    <input type="email" name="email" placeholder="Your email" required>
    <textarea name="message" rows="3" placeholder="Your message" required></textarea>
    <button>Submit</button>
  </form>
  <p class="msg" style="color:#27ae60"><?= htmlspecialchars($msg) ?></p>
<h3>Submitted feedback (<?= count($rows) ?>)</h3>
  <table>
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Time</th></tr>
    <?php foreach ($rows as $r): ?>
    <tr>
      <td><?= $r['id'] ?></td>
      <td><?= htmlspecialchars($r['name']) ?></td>
      <td><?= htmlspecialchars($r['email']) ?></td>
      <td><?= htmlspecialchars($r['message']) ?></td>
      <td><?= $r['submitted_at'] ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <p style="text-align:center"><a href="index.php">Home</a> | <a href="dashboard.php">Dashboard</a></p>
</div> 
