<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include 'core/init.php';
protecting_page();
if (empty($_POST)===false){
    $requried_field = array('current_password','new_password','new_password_again');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $requried_field) === true) {
            $errors[] = 'please fill requried field';
            break 1;
        }
    }
    if (md5($_POST['current_password']) === $user_data['password']){
        if (trim($_POST['new_password']) !== trim($_POST['new_password_again'])){
            $errors[] = 'your possword don\'t match';
        }
        else if (strlen($_POST['new_password']) < 6){
            $errors[] = 'please enter min 6 char pass';
        }
    }
    else {
        $errors[] = 'please enter right password';
    }
}

?>

<table align="center" cellspacing="0" cellpadding="0" class="caption">
    <tr>
        <td class="form">
            <h2>Change Password</h2>
            <?php
                if (isset($_GET['success']) && empty($_GET['success'])) {
                    echo "Password Changed Suceessfully.";
                }
                else{
                    if (empty($_POST) === false && empty($errors) === true){
                        change_password($session_user_id,$_POST['new_password']);
                        header('Location: changepassword.php?success');
                    }
                    else{
                        echo output_errors($errors);
                    }


            ?>
            <form action="" method="post">
                <div class="input-container">
                    <input type="password" id="current_password" name="current_password" required="required"/>
                    <label for="current_password">Current Password</label>
                    <div class="bar"></div>
                </div>
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
                    <button><span>Submit</span></button>
                </div>
            </form>
            <?php } ?>
            <a href="index.php">Go to Home Page </a>

        </td>
    </tr>
</table>


</body>
</html>