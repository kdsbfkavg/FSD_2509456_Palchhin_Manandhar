<?php

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string){
    $skills = explode(",", $string);
    return array_map("trim", $skills);
}

function saveStudents($name, $email, $skillsArray) {
    $file = __DIR__ . "/students.txt";

    $line = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;

    if (file_put_contents($file, $line, FILE_APPEND) === false) {
        throw new Exception("Failed to save student data.");
    }
}

function uploadPortfolioFile($file){
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024;

    if ($file['error'] !== 0) {
        throw new Exception("File upload error.");
    }

    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File exceeds 2MB size limit.");
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = "portfolio_" . time() . "." . $extension;

    if (!is_dir("uploads")) {
        throw new Exception("Upload directory missing.");
    }

    if (!move_uploaded_file($file['tmp_name'], "uploads/" . $newName)) {
        throw new Exception("Failed to move uploaded file.");
    }

    return $newName;
}

?>