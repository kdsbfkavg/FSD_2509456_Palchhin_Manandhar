<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h2>Welcome, <?= $_SESSION["name"] ?></h2>

<p>You are logged in successfully.</p>

<div class="btns">
    <div class="btn"><a href="preference.php">Theme</a></div>
    <div class="btn"><a href="logout.php">Logout</a></div>
</div>
</div>

</body>
</html>