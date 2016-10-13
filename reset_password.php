<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include 'core/init.php';
logged_in_redirect();
if (empty($_POST)===false){
    $requried_field = array('new_password','new_password_again');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requried_field) === true) {
            $errors[] = 'please fill requried field';
            break 1;
        }
    }
    if (trim($_POST['new_password']) !== trim($_POST['new_password_again'])){
        $errors[] = 'your possword don\'t match';
    }
    else if (strlen($_POST['new_password']) < 6){
        $errors[] = 'please enter min 6 char pass';
    }
}
?>

<table align="center" cellspacing="0" cellpadding="0" class="caption">
    <tr>
        <td class="form">
            <?php
            if(isset($_GET['success']) === true && empty($_GET['success']) === true){
                ?>
                <h2>Thenks, we've changed your password</h2>
                <p>you're free to log in! <a href="login.php">Login</a></p>
                <?php
            }
            else {
                if (isset($_GET['email'],$_GET['generate_password'])===true){
                    $email      = trim($_GET['email']);
                    $generate_password = trim($_GET['generate_password']);

                    $user_id = user_id_from_email($email);
                    $user_data = user_data($user_id,'username');
                    change_password($user_id,$generate_password);
                    $login = login($user_data['username'], $generate_password);
                    if ($login == true){
                        if (empty($_POST) === false && empty($errors) === true){
                            change_password($user_id,$_POST['new_password']);
                            header('Location: reset_password.php?success');
                        }
                        else{
                            echo output_errors($errors);
                        }
                        ?>
                        <form action="" method="post">
                            <div class="input-container">
                                <input type="password" id="new_password" name="new_password" required="required"/>
                                <label for="new_password">New Password</label>
                                <div class="bar"></div>
                            </div>
                            <div class="input-container">
                                <input type="password" id="new_password_again" name="new_password_again" required="required"/>
                                <label for="new_password_again">New Password Again</label>
                                <div class="bar"></div>
                            </div>
                            <div class="button-container">
                                <button><span>Reset</span></button>
                            </div>
                        </form>
                    <?php }


                }
                else{
                    header('Location: index.php');
                    exit();
                }
            }
            ?>

        </td>
    </tr>
</table>


</body>
</html>