?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

$theme = $_COOKIE["theme"] ?? "light";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    setcookie("theme", $_POST["theme"], time() + 86400 * 30);
    header("Location: preference.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Theme</title>
<link rel="stylesheet" href="style.css">

<style>
body {
    background-color: <?= $theme === "dark" ? "#111" : "#eef" ?>;
    color: <?= $theme === "dark" ? "#fff" : "#000" ?>;
}
</style>
</head>
<body>

<div class="card">
<h2>Theme Preference</h2>

<form method="POST">
    <select name="theme">
        <option value="light" <?= $theme === "light" ? "selected" : "" ?>>Light Mode</option>
        <option value="dark" <?= $theme === "dark" ? "selected" : "" ?>>Dark Mode</option>
    </select>

    <div class="btns">
        <button type="submit">Save</button>
        <div class="btn"><a href="dashboard.php">Back</a></div>
    </div>
</form>
</div>

</body>
