<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Blogarts = "Blogarts.db.10145227.hostedresource.com";
$database_Blogarts = "Blogarts";
$username_Blogarts = "Blogarts";
$password_Blogarts = "Marley!23";
$Blogarts = mysql_pconnect($hostname_Blogarts, $username_Blogarts, $password_Blogarts) or trigger_error(mysql_error(),E_USER_ERROR); 
?>