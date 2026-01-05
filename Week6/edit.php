<?php
$host = "localhost";
$dbname = "school_db";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

// Fetch existing data
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

// Update logic
if (isset($_POST['update'])) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $updateSql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $updateStmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($updateStmt, "sssi", $name, $email, $course, $id);
    mysqli_stmt_execute($updateStmt);

    header("Location: db_manipulation.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        padding: 30px;
    }

    h2 {
        text-align: center;
    }

    form {
        width: 400px;
        margin: auto;
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #27ae60;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #219150;
    }
</style>


<h2>Edit Student</h2>

<form method="post">
    Name: <br>
    <input type="text" name="name" value="<?= $student['name'] ?>" required><br><br>

    Email: <br>
    <input type="email" name="email" value="<?= $student['email'] ?>" required><br><br>

    Course: <br>
    <input type="text" name="course" value="<?= $student['course'] ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>