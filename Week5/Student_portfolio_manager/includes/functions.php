<?php

function formatName($name) {
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    return array_map('trim', explode(',', $string));
}

function saveStudent($name, $email, $skillsArray) {
    $data = "$name | $email | " . implode(', ', $skillsArray) . PHP_EOL;
    file_put_contents("students.txt", $data, FILE_APPEND);
}

function uploadPortfolioFile($file) {
    $allowed = ['pdf', 'jpeg', 'png'];

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $tmpPath = $file['tmp_name'];

    if (!in_array($extension, $allowed)) {
        throw new Exception("Invalid file type.");
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        throw new Exception("File too large (Max 2MB).");
    }

    $newName = time() . "" . pathinfo($file['name'], PATHINFO_FILENAME);
    move_uploaded_file($tmpPath, "uploads/" . $newName);

    return $newName;
}