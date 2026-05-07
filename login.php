<?php
session_start();
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        // read user details from file
        $user_file = "users/{$input_username}.txt";
        if (file_exists($user_file)) {
            $user_details = file_get_contents($user_file);
            $user_credentials = explode(',', $user_details);

            // check for valid credentials
            if ($user_credentials[0] === $input_username && $user_credentials[1] === $input_password) {
                // set session variables to remember the user
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $input_username;

                // redirect to the book appointment page
                header('Location: index.php');
                exit;
            } else {
                $message = '<p style="color: red;">Login failed. Incorrect username or password.</p>';
            }
        } else {
            $message = '<p style="color: red;">Login failed. User does not exist.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      
      /* --- BACKGROUND IMAGE SETTINGS --- */
      /* Replace 'background-image.jpg' with your actual image path */
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/back.jpeg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      background-repeat: no-repeat;
      /* --------------------------------- */
      
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .login-page {
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .form {
      background: #fff;
      max-width: 360px;
      width: 100%;
      padding: 50px 40px;
      border-radius: 10px;
      box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.3);
    }

    .form h2 {
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    .form input {
      border-radius: 5px;
      border: 1px solid #ddd;
      background: #f0f0f0;
      padding: 12px;
      margin-bottom: 20px;
      width: 100%;
      font-size: 14px;
      color: #333;
    }

    .form input:focus {
      outline: none;
      background: #e6e6e6;
      border-color: #4CAF50;
    }

    .form button {
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      padding: 12px;
      width: 100%;
      transition: all 0.2s ease;
      margin-top: 10px;
    }

    .form button.secondary {
      background-color: #764ba2;
      margin-top: 5px;
    }

    .form button:hover {
      filter: brightness(90%);
    }

    .form p {
        text-align: center;
        font-size: 14px;
        margin-top: 15px;
    }
  </style>
</head>
<body>

  <div class="login-page">
    <div class="form">
      
      <h2>Login</h2>
      <?php echo $message; ?>
      
      <form action="login.php" method="post" class="login-form">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required> 
      
        <button type="submit">Login</button>
        <button type="button" class="secondary" onclick="window.location.href='changepass.php'">Change Password</button>
      </form>

      <p>Not registered yet? <a href="register.php">Register here</a></p>
    </div>
  </div>

</body>
</html>