<?php
require "functions.php";
include "includes/header.php";


$errors = [];
$success = "";
$message = "";
$name = $email = $skills = "";

try{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $skills = trim($_POST["skills"]);
    

    if (empty($name)) {
        $errors["name"] = "Name is required.";
    } elseif (strlen($name) < 3) {
        $errors["name"] = "Name must be at least 3 characters.";
    }


    if(empty($email)){
        $errors["email"] = "Email is required";
    }

    if (empty($skills)) {
            $errors["skills"] = "Skills cannot be empty.";
        } else {
            $skillsArray = cleanSkills($skills);
        }

        if (empty($errors)) {
            saveStudents($name, $email, $skillsArray);
            $success = "Student added successfully!";

            $name = $email = $skills = "";
        }

    }
}
catch(Exception $e) {
        $message = $e->getMessage();
}
?>

<html>
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

            body{
                display: flex;
                flex-direction: column;
            }

            .detail{
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            form {
                background-color: #f2f2f2;
                width: 300px;
                margin: 50px;
                padding: 20px;
                border-radius: 20px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            }

            label {
                display: inline-block;
                width: 100px;
            }

            input{
                padding: 7px;
                border-radius: 10px;
                width: 100%;

            }

            button{
                display: block;
                margin: auto;
                padding: 5px;
                border-radius: 10px;
            }

            button:hover{
                background-color: #ddd;
                cursor: pointer;
                transform: scale(1.04);
            }
        </style>
        <div class = "detail">
            <form method  = "POST">
                <h3 style = "text-align: center; margin-bottom: 10px;"> Student Information </h3>

                <label>Name: </label><br>
                <input type = "text" name = "name" value="<?= htmlspecialchars($name) ?>"><br>
                <p style = "color: red;"><?php echo $errors["name"] ?? "" ?></p><br>

                <label> Email: </label><br>
                <input type = "email" name = "email" value="<?= htmlspecialchars($email) ?>"><br>
                <p style = "color: red;"><?php echo $errors["email"] ?? "" ?></p><br>

                <label> Skills: </label><br>
                <input type = "text" name = "skills" value="<?= htmlspecialchars($skills) ?>"><br>
                <p style = "color: red;"><?php echo $errors["skills"] ?? "" ?></p><br>

                <button type = "submit" name = "submit"> Submit </button>
                <?php if (!empty($success)): ?>
                <p style="color: green; text-align: center; margin-top: 10px;"><?= $success ?></p>
                <?php endif; ?>
                </p>        
            </form>
        </div>
    </body>
</html>

<?php
include "includes/footer.php";
?>