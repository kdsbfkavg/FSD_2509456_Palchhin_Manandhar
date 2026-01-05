<?php
require "db.php";

$errors = [];
$success = "";

$student_id = $name = $password = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $student_id = trim($_POST["student_id"] ?? "");
    $name = trim($_POST["name"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($student_id)) {
        $errors["student_id"] = "Student ID is required.";
    }

    if (empty($name)) {
        $errors["name"] = "Name is required.";
    } elseif (strlen($name) < 3) {
        $errors["name"] = "Name must be at least 3 characters.";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Password must be at least 6 characters.";
    }

    if (empty($errors)) {
        try {
            $hashed = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $conn->prepare(
                "INSERT INTO students (student_id, full_name, password_hash)
                 VALUES (:student_id, :full_name, :password_hash)"
            );

            $stmt->execute([
                ":student_id" => $student_id,
                ":full_name" => $name,
                ":password_hash" => $hashed
            ]);

            $success = "Registration successful! You can now login.";

            $student_id = $name = $password = "";

        } catch (PDOException $e) {
            $errors["student_id"] = "Student ID already exists.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h2>Student Registration</h2>

<?php if (!empty($success)): ?>
    <p class="success"><?= $success ?></p>
<?php endif; ?>

<form method="POST">

    <label>Student ID</label>
    <input type="text" name="student_id" value="<?= $student_id ?>">
    <p class="error"><?= $errors["student_id"] ?? "" ?></p>

    <label>Name</label>
    <input type="text" name="name" value="<?= $name ?>">
    <p class="error"><?= $errors["name"] ?? "" ?></p>

    <label>Password</label>
    <input type="password" name="password">
    <p class="error"><?= $errors["password"] ?? "" ?></p>

    <div class="btns">
        <button type="submit">Register</button>
        <div class="btn"><a href="login.php">Login</a></div>
    </div>

</form>
</div>

</body>
</html>