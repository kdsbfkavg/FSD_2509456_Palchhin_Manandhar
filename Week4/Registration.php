<?php
$errors = [];
$success = "";

$usersFile = "users.json";

if (file_exists($usersFile)) {
    $jsonData = file_get_contents($usersFile);
    $users = json_decode($jsonData, true);
} else {
    $users = [];
}

$name = "";
$email = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if (empty($name)) {
        $errors['name'] = "Name is required";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    }

    if (empty($confirmPassword)) {
        $errors['confirm'] = "Please confirm your password";
    } elseif ($password !== $confirmPassword) {
        $errors['confirm'] = "Passwords do not match";
    }

    foreach ($users as $user) {
        if (strtolower($user['name']) === strtolower($name)) {
            $errors['name'] = "This name is already taken";
        }
        if (strtolower($user['email']) === strtolower($email)) {
            $errors['email'] = "This email is already registered";
        }
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $newUser = [
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword
        ];

        $users[] = $newUser;
        $encodedData = json_encode($users, JSON_PRETTY_PRINT);

        if (file_put_contents($usersFile, $encodedData)) {
            $success = "Registration successful!";
            $name = $email = $password = $confirmPassword = "";
        } else {
            $errors['file'] = "Failed to save user data";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        div{
            background-color: lightgrey;
            width: 400px;
            padding: 20px;
            border-radius: 20px;
        }

        input{
            border-radius: 10px;
            padding: 5px;
            width: 95%;
            margin-bottom: 5px;
        }

        button{
            margin-left: 35%;
            border-radius: 10px;
            padding: 8px 15px;
            cursor: pointer;
        }

        .error {
            color: #d8000c;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85em;
            display: inline-block;
            margin-top: 3px;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div>
        <?php if($success) echo "<p class='success'>$success</p>"; ?>
        <form method="POST">
            <label> Name: </label><br>
            <input type="text" placeholder="Enter your Name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
            <span class="error"><?php if (isset($_POST['name']))echo $errors['name'] ?? ''; ?></span><br><br>

            <label> Email: </label><br>
            <input type="email" placeholder="Enter your Email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            <span class="error"><?php if (isset($_POST['email']))echo $errors['email'] ?? ''; ?></span><br><br>

            <label> Password: </label><br>
            <input type="password" placeholder="Enter your Password" name="password">
            <span class="error"><?php if (isset($_POST['password'])) echo $errors['password'] ?? ''; ?></span><br><br>

            <label> Confirm Password: </label><br>
            <input type="password" placeholder="Confirm your Password" name="confirmPassword">
            <span class="error">
                <?php if (isset($_POST['register'])) echo $errors['confirm'] ?? ''; ?>
            </span><br><br>

            <button type="submit" name="register"> Submit </button>
        </form>
    </div>
</body>
</html>