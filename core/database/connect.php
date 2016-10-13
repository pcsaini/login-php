<?php
$connect_error = 'sorry problems in connection';
mysql_connect('localhost','root','') or die($connect_error);
mysql_select_db('login') or die($connect_error);

/*mysql_connect("localhost","1190736","pcsaini.")  or die($connect_error);
mysql_select_db("1190736") or die($connect_error);*/
?>