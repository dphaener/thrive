<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_ThriveUsers = "thriveusers.db.10145227.hostedresource.com";
$database_ThriveUsers = "thriveusers";
$username_ThriveUsers = "thriveusers";
$password_ThriveUsers = "Marley!23";
$ThriveUsers = mysql_pconnect($hostname_ThriveUsers, $username_ThriveUsers, $password_ThriveUsers) or trigger_error(mysql_error(),E_USER_ERROR); 
?>