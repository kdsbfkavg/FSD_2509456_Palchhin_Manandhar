<?php
require 'includes/header.php';
$students = file_exists('students.txt') ? file('students.txt') : [];
?>

<div class="container">
    <h2>Students List</h2>

    <?php foreach ($students as $s): ?>
        <?php list($n,$e,$sk) = explode('|', $s); ?>
        <p>
            <strong><?= $n ?></strong><br>
            <?= $e ?><br>
            Skills: <?= $sk ?>
        </p>
        <hr>
    <?php endforeach; ?>
</div>

<?php require 'includes/footer.php'; ?>