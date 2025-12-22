<?php
session_start();

// --- Helper: initialize variables
$errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'general' => ''
];
$old = ['name' => '', 'email' => ''];

// --- If form submitted, validate and process
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simple sanitization for display purposes
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $old['name'] = htmlspecialchars($name, ENT_QUOTES);
    $old['email'] = htmlspecialchars($email, ENT_QUOTES);

    // Validation
    $valid = true;

    if ($name === '') {
        $errors['name'] = 'Name is required.';
        $valid = false;
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'Name must be at least 2 characters.';
        $valid = false;
    }

    if ($email === '') {
        $errors['email'] = 'Email is required.';
        $valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
        $valid = false;
    }

    // Password policy: min 8 chars, 1 uppercase, 1 lowercase, 1 digit, 1 special char
    $pwd_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if ($password === '') {
        $errors['password'] = 'Password is required.';
        $valid = false;
    } elseif (!preg_match($pwd_pattern, $password)) {
        $errors['password'] = 'Password must be at least 8 chars and include uppercase, lowercase, number and special character.';
        $valid = false;
    }

    if ($confirm_password === '') {
        $errors['confirm_password'] = 'Please confirm your password.';
        $valid = false;
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match.';
        $valid = false;
    }

    // If validation passed, process registration
    if ($valid) {
        $file = __DIR__ . '/users.json';

        // Read existing users
        if (!is_readable($file)) {
            $errors['general'] = 'User data file not found or not readable.';
        } else {
            $json = file_get_contents($file);
            if ($json === false) {
                $errors['general'] = 'Failed to read user data file.';
            } else {
                $users = json_decode($json, true);
                if (!is_array($users)) {
                    $users = []; // recover if file corrupted
                }

                // Check for duplicate email
                $email_exists = false;
                foreach ($users as $u) {
                    if (isset($u['email']) && strtolower($u['email']) === strtolower($email)) {
                        $email_exists = true;
                        break;
                    }
                }

                if ($email_exists) {
                    $errors['email'] = 'This email is already registered.';
                } else {
                    // Hash password
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    // New user array
                    $new_user = [
                        'name' => $name,
                        'email' => $email,
                        'password_hash' => $password_hash,
                        'registered_at' => date('c')
                    ];

                    // Append and write back with locking
                    $users[] = $new_user;
                    $encoded = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

                    // Attempt to write safely
                    $tmpfile = $file . '.tmp';
                    $write_ok = file_put_contents($tmpfile, $encoded, LOCK_EX);
                    if ($write_ok === false) {
                        $errors['general'] = 'Failed to write user data (tmp file).';
                    } else {
                        // Replace original atomically
                        if (!rename($tmpfile, $file)) {
                            $errors['general'] = 'Failed to finalize user data file.';
                        } else {
                            // Success
                            $_SESSION['success_message'] = 'Registration successful! You can now log in.';
                            // Optionally redirect to avoid form re-submission
                            header('Location: ' . $_SERVER['PHP_SELF']);
                            exit;
                        }
                    }
                }
            }
        }
    }
}

// Display page (errors preserved in $errors)
$success_message = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User registration</title>
<style>
  body { font-family: Arial, sans-serif; max-width:700px; margin:2rem auto; padding:0 1rem;}
  .field { margin-bottom:1rem; }
  label { display:block; font-weight:600; margin-bottom:.25rem; }
  input[type="text"], input[type="email"], input[type="password"] { width:100%; padding:.5rem; font-size:1rem; }
  .error { color:#b00020; font-size:.9rem; margin-top:.25rem; }
  .success { color: #0a0; background:#f0fff0; padding: .5rem; border: 1px solid #cfc; margin-bottom:1rem; }
  .general-error { color:#b00020; background:#fff0f0; padding:.5rem; border:1px solid #f5c; margin-bottom:1rem; }
  button { padding:.6rem 1rem; font-size:1rem; border-radius:.25rem; cursor:pointer; }
</style>
</head>
<body>

<h1>Create an account</h1>

<?php if ($success_message): ?>
  <div class="success"><?= htmlspecialchars($success_message) ?></div>
<?php endif; ?>

<?php if ($errors['general']): ?>
  <div class="general-error"><?= htmlspecialchars($errors['general']) ?></div>
<?php endif; ?>

<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <div class="field">
    <label for="name">Full name</label>
    <input id="name" name="name" type="text" value="<?= $old['name'] ?>">
    <?php if ($errors['name']): ?><div class="error"><?= htmlspecialchars($errors['name']) ?></div><?php endif; ?>
  </div>

  <div class="field">
    <label for="email">Email address</label>
    <input id="email" name="email" type="email" value="<?= $old['email'] ?>">
    <?php if ($errors['email']): ?><div class="error"><?= htmlspecialchars($errors['email']) ?></div><?php endif; ?>
  </div>

  <div class="field">
    <label for="password">Password</label>
    <input id="password" name="password" type="password" autocomplete="new-password">
    <?php if ($errors['password']): ?><div class="error"><?= htmlspecialchars($errors['password']) ?></div><?php endif; ?>
  </div>

  <div class="field">
    <label for="confirm_password">Confirm password</label>
    <input id="confirm_password" name="confirm_password" type="password" autocomplete="new-password">
    <?php if ($errors['confirm_password']): ?><div class="error"><?= htmlspecialchars($errors['confirm_password']) ?></div><?php endif; ?>
  </div>

  <button type="submit">Register</button>
</form>

</body>
</html>
