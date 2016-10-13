<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover</title>
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
        p{
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
                <h2>Recover Username or Password</h2>
                <p>Please Enter Email address</p>
                <?php
                $mode_allowed = array('username','password');
                if (isset($_GET['success']) && empty($_GET['success'])) {
                    echo "<p>Thanks we've emailed you to recover password</p>";
                }
                else {
                    if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
                        if (isset($_POST['email']) === true && empty($_POST['email']) === false) {
                            if (email_exists($_POST['email']) === true) {
                                recover($_GET['mode'], $_POST['email']);
                                header('Location: recover.php?success');
                                exit();
                            } else {
                                echo '<p>we can not find your email address</p>';
                            }
                        }
                        ?>
                        <form action="" method="post">
                            <div class="input-container">
                                <input type="email" id="email" name="email" required="required"/>
                                <label for="email">Email</label>
                                <div class="bar"></div>
                            </div>
                            <div class="button-container">
                                <button><span>Submit</span></button>
                            </div>
                        </form>
                        <?php
                    } else {
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