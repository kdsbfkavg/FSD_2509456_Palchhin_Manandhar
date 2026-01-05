<?php
session_start();
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = trim($_POST["student_id"]);
    $password = $_POST["password"];

    if (!$student_id || !$password) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare(
            "SELECT * FROM students WHERE student_id = :id"
        );
        $stmt->execute([":id" => $student_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password_hash"])) {
            $_SESSION["logged_in"] = true;
            $_SESSION["name"] = $user["full_name"];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid credentials.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h2>Student Login</h2>

<?php if ($error): ?>
<p class="error"><?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="student_id" placeholder="Student ID"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>

    <div class="btns">
        <button type="submit">Login</button>
        <div class="btn"><a href="register.php">Register</a></div>
    </div>
</form>
</div>

</body>
</html>