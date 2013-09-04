<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Forum = "forumitems.db.10145227.hostedresource.com";
$database_Forum = "forumitems";
$username_Forum = "forumitems";
$password_Forum = "Marley!23";
$Forum = mysql_pconnect($hostname_Forum, $username_Forum, $password_Forum) or trigger_error(mysql_error(),E_USER_ERROR); 
?>