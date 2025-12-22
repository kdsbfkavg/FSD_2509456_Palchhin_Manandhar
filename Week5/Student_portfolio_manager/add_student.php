<?php
require 'includes/functions.php';
require 'includes/header.php';

$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = formatName($_POST['name']);
        $email = $_POST['email'];
        $skills = cleanSkills($_POST['skills']);

        if (!$name || !$email || empty($skills)) {
            throw new Exception("All fields required.");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email.");
        }

        saveStudent($name, $email, $skills);
        $success = "Student added successfully!";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<div class="container">
    <h2>Add Student</h2>

    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    <?php if ($success) echo "<p style='color:green'>$success</p>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name">
        <input type="text" name="email" placeholder="Email">
        <textarea name="skills" placeholder="Skills (comma separated)"></textarea>
        <button>Add Student</button>
    </form>
</div>

<?php require 'includes/footer.php'; ?>