<?php
include 'includes/header.php';
?>

<html>
<body>

<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    html, body{
        height: 100%;
    }

    body{
        display: flex;
        flex-direction: column;
    }

    .student_info{
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 40px 20px;
    }

    .students-wrapper{
        width: 100%;
        max-width: 600px;
    }

    .student-card{
        background-color: #ffffff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .student-card h3{
        margin-bottom: 10px;
        color: #333;
    }

    .student-card p{
        margin-bottom: 8px;
        color: #555;
    }

    .skills{
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .skill{
        background-color: #e0e0e0;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 14px;
    }

    .no-students{
        color: #777;
        font-size: 18px;
        text-align: center;
    }
</style>

<div class="student_info">
<div class="students-wrapper">

<?php
if (!file_exists("students.txt")) {
    echo "<p class='no-students'>No students found.</p>";
} else {
    $lines = file("students.txt", FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        list($name, $email, $skills) = explode("|", $line);
        $skillsArray = explode(",", $skills);

        echo "<div class='student-card'>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<div class='skills'>";

        echo "<p><strong>Skills:</strong></p>";
        foreach ($skillsArray as $skill) {
            echo "<span class='skill'>$skill</span>";
        }

        echo "</div>";
        echo "</div>";
    }
}
?>

</div>
</div>

</body>
</html>

<?php
require 'includes/footer.php';
?>