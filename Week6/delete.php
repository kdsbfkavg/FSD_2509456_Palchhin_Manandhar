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

$sql = "DELETE FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: db_manipulation.php"); // go back to list
exit;

?>