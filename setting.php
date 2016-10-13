<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Setting</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include 'core/init.php';
if (logged_in()) {
    echo "<h1 style='text-align: center'> Hello ".$user_data[frist_name]."</h1>";
    echo '<a href="logout.php">logout</a>';

    if (empty($_POST) === false) {
        $required_field = array('frist_name','email');

        /*echo '<pre>', print_r($_POST,true), '</pre>';*/
        foreach ($_POST as $key => $value) {
            if (empty($value) && in_array($key, $required_field) === true) {
                $errors[] = 'Please fill Require field';
                break 1;
            }
        }
        if (empty($errors) === true) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                $errors[] = 'email is not valid';
            }
            else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
                $errors[] = 'Email already use';
            }
        }
    }

    ?>

    <table align="center" cellspacing="0" cellpadding="0" class="caption">
        <tr>
            <td class="form">
                <h2>Setting</h2>
                <?php
                if (isset($_GET['success']) && empty($_GET['success'])) {
                            echo "your update Suceessfully updated";
                }
                else{
                    if (empty($_POST) === false && empty($errors) === true) {
                        $update_data = array(
                                'frist_name'    => $_POST['frist_name'],
                                'last_name'     => $_POST['last_name'],
                                'email'         => $_POST['email']
                                );

                            //print_r($update_data);
                            update_user($update_data);
                            header('Location: Setting.php?success');
                            exit();
                    }
                    else if (empty($errors) === true) {
                        echo output_errors($errors);
                    }


                ?>
                <form action="" method="post">
                    <div class="input-container">
                        <input type="text" id="frist_name" name="frist_name" value="<?php echo $user_data['frist_name']?>" required="required"/>
                        <label for="frist_name">Frist Name</label>
                        <div class="bar"></div>
                    </div>
                    <div class="input-container">
                        <input type="text" id="last_name" name="last_name" value="<?php echo $user_data['last_name']?>"/>
                        <label for="last_name">Last Name</label>
                        <div class="bar"></div>
                    </div>
                    <div class="input-container">
                        <input type="email" id="email" name="email" value="<?php echo $user_data['email']?>" required="required"/>
                        <label for="email">Email</label>
                        <div class="bar"></div>
                    </div>
                    <div class="button-container">
                        <button><span>Update</span></button>
                    </div>
                    <div class="footer">
                        <a href="index.php">Home Page</a>
                    </div>
                </form>
                <?php } ?>
            </td>
        </tr>
    </table>

<?php
}
else{
    header('Location: login.php');
    exit();
}?>
</body>
</html>