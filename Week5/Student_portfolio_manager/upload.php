<?php
require 'includes/functions.php';
require 'includes/header.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        uploadPortfolioFile($_FILES['portfolio']);
        $msg = "File uploaded successfully!";
    } catch (Exception $e) {
        $msg = $e->getMessage();
    }
}
?>

<div class="container">
    <h2>Upload Portfolio</h2>
    <p><?= $msg ?></p>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="portfolio" required>
        <button>Upload</button>
    </form>
</div>

<?php require 'includes/footer.php'; ?>../