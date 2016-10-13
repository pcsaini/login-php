<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include 'core/init.php';
logged_in_redirect();
?>

<table align="center" cellspacing="0" cellpadding="0" class="caption">
    <tr>
        <td class="form">
            <?php
            if(isset($_GET['success']) === true && empty($_GET['success']) === true){
                ?>
                    <h2>Thenks, we've activated your account</h2>
                    <p>you're free to log in!</p>
                <?php
            }
            else if (isset($_GET['email'],$_GET['email_code'])===true){
                $email      = trim($_GET['email']);
                $email_code = trim($_GET['email_code']);

                if (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0"),0) == 1 ){
                    //query for update user active status
                    mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$email'");
                    
                    header('Location: activate.php?success');
                    exit();
                }
                else{
                    echo "some errors";
                }

                /*if (email_exists($email) === false) {
                    $errors[] = 'Oops somthing went wrong, and we can\'t find that email address';
                }
                
                else if(activate($email, $email_code) == false) {
                    die("some problem");
                    $errors[] = 'we had problems activating your accouont';
                }
                
                
                if(empty($errors) === false){
                ?>
                    <h2>Oops...</h2>
                <?php
                    echo output_errors($errors);
                }
                else{
                    header('Location: acivate.php?success');
                    exit();
                }*/
            }   
            else{
                header('Location: index.php');
                exit();
            }


            ?>

        </td>
    </tr>
</table>


</body>
</html>