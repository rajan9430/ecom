<?php
session_start();
require_once '../class/Crud.php'; // Include your Crud class

$crud = new Crud();
$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch admin details from the database
    $admin = $crud->custom_get('admins', "WHERE username = '$username'", 'fetch');

    // echo '<pre>'; print_r($admin); die();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: index.php');
        exit;
    } else {
        $loginError = 'Invalid username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            text-align: center;
            font-size: 2rem;
            color: #6a11cb;
        }
        .btn-login {
            background: #6a11cb;
            border: none;
        }
        .btn-login:hover {
            background: #2575fc;
        }
        .form-control {
            border-radius: 30px;
        }
        .alert-danger {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header mb-4">
            <h2>Admin Login</h2>
        </div>
        <?php if (!empty($loginError)): ?>
            <div class="alert alert-danger"><?= $loginError; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-login w-100 btn-lg">Login</button>
        </form>
    </div>
</body>
</html>
