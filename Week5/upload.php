<?php
require "functions.php";
include "includes/header.php";

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        if (!isset($_FILES["portfolio"])) {
            throw new Exception("No file selected.");
        }

        $filename = uploadPortfolioFile($_FILES["portfolio"]);
        $message = "File uploaded successfully: $filename";

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<html>
<head>
    <title>My PHP Page</title>
</head>

<body>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,body{
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .upload_container{
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .upload_container div {
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .uploads{
        border: 1px solid black;
        margin-top: 10px;
        padding: 10px;
        border-radius: 10px;
        transition: 0.3s;
        text-align: center;
    }

    .uploads:hover{
        background-color: #ddd;
        cursor: pointer;
        transform: scale(1.04);
    }

    input{
        width: 100%;
        margin-top: 10px;
        transition: 0.5s;
    }

    input:hover{
        transform: scale(1.04);
    }

    button{
        margin-top: 10px;
        width: 100%;
        padding: 7px;
        border-radius: 10px;
    }
</style>

<div class="upload_container">
<div>

    <h3 style="text-align:center;">Upload PDF / JPG / PNG</h3><br>

    <form method="POST" enctype="multipart/form-data">

        <input type="file" name="portfolio" required>

        <button class = "uploads" type="submit">Upload File</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <?php if (!empty($message)): ?>
            <p style="color:green; margin-top:10px;"><?= $message ?></p>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <p style="color:red; margin-top:10px;"><?= $error ?></p>
        <?php endif; ?>
    <?php endif; ?>

</div>
</div>

</body>
</html>

<?php include "includes/footer.php"; ?>