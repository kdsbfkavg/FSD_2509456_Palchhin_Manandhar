<?php
    $host = "localhost";
    $dbname = "school_db";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM students";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        table { border-collapse: collapse; width: 60%; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background-color: #eee; }
    </style>
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
        margin-bottom: 20px;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        margin: auto;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #2c3e50;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    a {
        text-decoration: none;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 14px;
    }

    .edit {
        background-color: #3498db;
        color: white;
    }

    .delete {
        background-color: #e74c3c;
        color: white;
    }

    .edit:hover {
        background-color: #2980b9;
    }

    .delete:hover {
        background-color: #c0392b;
    }
</style>


<h2>Student List</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Change</th>

    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
    <td>{$row['name']}</td>
    <td>{$row['email']}</td>
    <td>{$row['course']}</td>
    <td>
        <a class='edit' href='edit.php?id={$row['id']}'>Edit</a>
        <a class='delete'
            href='delete.php?id={$row['id']}'
            onclick=\"return confirm('Are you sure you want to delete?');\">
            Delete
        </a>
    </td>
    </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>
</table>

</body>
</html>