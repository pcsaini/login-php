<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body{
            color: #fff;
        }
        a{
            color: #f5f5f5;
            text-decoration: none;
        }
        a:hover{
            color: #fff;
        }
        ul{
            list-style: none;
        }
    </style>
</head>
<body>
<?php
include 'core/init.php';
logged_in_redirect();

if (empty($_POST) === false) {
    $required_field = array('username','password','password_again','frist_name','email');

    /*echo '<pre>', print_r($_POST,true), '</pre>';*/
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_field) === true) {
            $errors[] = 'Please fill Require field';
            break 1;
        }
    }
    //print_r($_POST['password_again']);
    if (empty($errors) === true) {
        if (user_exists($_POST['username']) === true) {
            $errors[] = 'Sorry useername \''. $_POST['username'].'\' is allready Exist.';
        }
        if (preg_match("/\\s/", $_POST['username']) == true) {
            $errors[] = 'sorry username don\'t have space.';
        }
        if (strlen($_POST['password']) < 6) {
            $errors[] = 'password is too short';
        }
        if ($_POST['password'] !== $_POST['password_again']) {
            $errors[] = 'password is don\'t match';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'email is not valid';
        }
        if (email_exists($_POST['email']) === true) {
            $errors[] = 'Sorry email \''. $_POST['email'].'\' is allready Exist.';
        }
    }

}
?>

<table align="center" cellspacing="0" cellpadding="0" class="caption">
    <tr>
        <td class="form">
            <h2>Register</h2>
            <?php
            if (isset($_GET['success']) && empty($_GET['success'])) {
                echo "you have registered Suceessfully. please cheack your email to activate your account.";
            }
            else{
                if (empty($_POST) === false && empty($errors) === true) {
                    $register_data = array(
                        'username' 		=> $_POST['username'],
                        'password' 		=> $_POST['password'],
                        'frist_name' 	=> $_POST['frist_name'],
                        'last_name' 	=> $_POST['last_name'],
                        'email' 		=> $_POST['email'],
                        'email_code'	=> md5($_POST['username']+ microtime())
                    );

                    //print_r($register_data);
                    register_user($register_data);
                    header('Location: register.php?success');
                    exit();
                }
                else{
                    echo output_errors($errors);
                }
                ?>
                <form action="register.php" method="post">
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
                    <div class="input-container">
                        <input type="password" id="Password" name="password_again" required="required"/>
                        <label for="Password">Re-enter Password</label>
                        <div class="bar"></div>
                    </div>
                    <div class="input-container">
                        <input type="text" id="Username" name="frist_name" required="required"/>
                        <label for="Username">Frist Name</label>
                        <div class="bar"></div>
                    </div>
                    <div class="input-container">
                        <input type="text" id="Username" name="last_name" required="required"/>
                        <label for="Username">Last Name</label>
                        <div class="bar"></div>
                    </div>
                    <div class="input-container">
                        <input type="text" id="Username" name="email" required="required"/>
                        <label for="Username">E-mail Address</label>
                        <div class="bar"></div>
                    </div>
                    <div class="button-container">
                        <button type="submit" value="Register"><span>Register</span></button>
                    </div>
                    <div class="footer">Already Exist?
                        <a href="login.php">Login</a>
                    </div>
                </form>
            <?php } ?>


        </td>
    </tr>
</table>

</body>
</html>