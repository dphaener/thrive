<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_localDB = "localhost";
$database_localDB = "blogarts";
$username_localDB = "root";
$password_localDB = "";
$localDB = mysql_pconnect($hostname_localDB, $username_localDB, $password_localDB) or trigger_error(mysql_error(),E_USER_ERROR); 
?>