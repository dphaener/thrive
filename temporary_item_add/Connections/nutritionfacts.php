<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_nutritionfacts = "localhost";
$database_nutritionfacts = "dhaener_nutritionfacts";
$username_nutritionfacts = "dhaener_dhaener";
$password_nutritionfacts = "Marley!23";
$nutritionfacts = mysql_pconnect($hostname_nutritionfacts, $username_nutritionfacts, $password_nutritionfacts) or trigger_error(mysql_error(),E_USER_ERROR); 
?>