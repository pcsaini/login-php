<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style type="text/css">
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
<?php
include 'core/init.php';
logged_in_redirect();
?>

<table align="center" cellspacing="0" cellpadding="0" class="caption">
    <tr>
        <td class="form">
            <h2>Login</h2>
            <div class="error" style="color:red; text-align: center;">
                <?php
                if (empty($_POST) == false) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    if (empty($username) === true || empty($password) === true) {
                        $errors[] = 'Please enter username and password';
                    }
                    if (user_exists($username) === false) {
                        $errors[] = 'Invailed usernames';
                    }
                    else if (user_active($username) === false) {
                        $errors[] = 'you have not active account';
                    }
                    else{
                        if (strlen($password)>32) {
                            $errors[] = 'password too long';
                        }

                        $login = login($username, $password);
                        if ($login == false) {
                            $errors[] = 'username and password is incorrect';
                        }
                        else{
                            $_SESSION['user_id'] = $login;
                            header('Location: index.php');
                        }
                    }

                }
                echo output_errors($errors);
                ?>
            </div>
            <form action="login.php" method="post">
                <div class="input-container">
                    <input type="text" id="Username" name="username" required="required"/>
                    <label for="Username">Username</label>
                    <div class="bar"></div>
                </div>
                <div class="input-container">
                    <input type="password" id="Password" name="password" required="required"/>
                    <label for="Password">Password</label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button><span>Login</span></button>
                </div>
                <div class="footer">
                    Forgot your <a href="recover.php?mode=username">username</a> or <a href="recover.php?mode=password">password?</a>
                </div>
                <div class="footer">New User?
                    <a href="register.php">Register</a>
                </div>
            </form>
           
        </td>
    </tr>
</table>


</body>
</html>