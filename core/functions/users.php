<?php
function recover($mode, $email){
    $mode   = sanitize($mode);
    $email  = sanitize($email);
    $user_id = user_id_from_email($email);

    $user_data = user_data($user_id,'frist_name','username');
    if ($mode == 'username'){
        mail($email,'Your username',"Hello ". $user_data['frist_name'] .",\nYour username is: ".$user_data['username']."\n\n  -pcsaini",'From:premchandsaini779@gmail.com');
    }else if ($mode == 'password'){
        $generate_password = substr(md5(rand(999,99999)),0,8);
        mail($email,'Reset Password',"Hello ". $user_data['frist_name'] .",\n Please go to above link to reset password :\n http://olib.freeoda.com/reset_password.php?email=".$email."&generate_password=".$generate_password."  \n\n  -pcsaini",'From:premchandsaini779@gmail.com');
        }
}
function update_user($update_data){
	global $session_user_id;
	$update = array();
	array_walk($update_data, 'array_sanitize');

	//print_r($register_data);
	foreach ($update_data as $fields => $data) {
		$update[] = '`'.$fields.'` = \''.$data.'\'';
	}
	
	mysql_query("UPDATE `users` SET ".implode(', ',$update)." WHERE `user_id` = 	$session_user_id") or die(mysql_error());
	
	//mysql_query("INSERT INTO users ($fields) VALUES ($data)");
	//mail($register_data['email'],'Activate Your Account',"Hello ". $register_data['frist_name'] .", You need to activate your account, so use the link below:\n\n http://olib.freeoda.com/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']." \n\n  -pcsaini",'From:premchandsaini779@gmail.com');

}
function change_password($user_id, $new_password){
    $user_id = (int)$user_id;
    $new_password = md5($new_password);

    mysql_query("UPDATE `users` SET `password` = '$new_password' WHERE `user_id` = $user_id");
}
function register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);

	//print_r($register_data);
	$fields = '`' . implode('`, `', array_keys($register_data)). '`';
	$data =  '\'' . implode('\', \'', ($register_data)). '\'';

	mysql_query("INSERT INTO users ($fields) VALUES ($data)");
	mail($register_data['email'],'Activate Your Account',"Hello ". $register_data['frist_name'] .", You need to activate your account, so use the link below:\n\n http://olib.freeoda.com/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']." \n\n  -pcsaini",'From:premchandsaini779@gmail.com');

}

function user_data($user_id){
	$data = array();
	$user_id = (int)$user_id;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		$fields = '`' . implode('`, `', $func_get_args). '`';
		//echo "SELECT $fields FROM users WHERE user_id = $user_id";
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM users WHERE user_id = $user_id"));

		return $data;
	}
}
//function For Login
function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false;
}

function user_exists($username){
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT('user_id') FROM users WHERE username = '$username'  "), 0) == 1) ? true : false;
}


function user_active($username){
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT count('user_id') FROM users WHERE username = '$username' AND active = 1 "), 0) == 1) ? true : false;
}

function user_id_from_username($username){
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT user_id FROM users WHERE username = '$username'  "), 0, 'user_id'));
}
function user_id_from_email($email){
    $email = sanitize($email);
    return (mysql_result(mysql_query("SELECT user_id FROM users WHERE email = '$email'  "), 0, 'user_id'));
}
function login($username, $password){
	$user_id = user_id_from_username($username);

	$username = sanitize($username);
	$password = md5($password);
	return (mysql_result(mysql_query("SELECT count('user_id') FROM users WHERE username = '$username' AND password = '$password' "), 0)==1) ? $user_id : false;
}

//function for Rregister 
function email_exists($email){
	$email = sanitize($email);
	return (mysql_result(mysql_query("SELECT COUNT('user_id') FROM users WHERE email = '$email'  "), 0) == 1) ? true : false;
}

?>