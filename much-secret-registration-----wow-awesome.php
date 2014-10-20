<?php 

$info = "";

if(isset($_GET["key"])) {
	if($_GET["key"] == "1f2fc41af4cb4d2497168aaa333a91ad") {
		define("MB_INIT", "true");
	}
}

require_once 'mb-config.php';
require_once 'app/core/Core.php';
require_once 'app/core/MySQL.php';

if(isset($_POST["register"])) {
	$mysql = new MySQL();
	$mysql->setData(MBDB_HOST, MBDB_USER, MBDB_PASSWORD, MBDB_NAME);
	$mysql->setCharset(MBDB_CHARSET);
	$mysql->connect();
	
	$mc_username = Core::MYSQL_PROTECT($_POST["mc-username"]);
	$display_name = Core::MYSQL_PROTECT($_POST["display-name"]);
	$email = Core::MYSQL_PROTECT($_POST["email"]);
	$password = Core::MYSQL_PROTECT($_POST["password"]);
	$password = Core::HASH_DATA_TP2($password);
	
	$date = time();
	
	$query = $mysql->query("INSERT INTO `mb_users` values('', '$mc_username', '$display_name', '$password', '$email', '$date', '0', '0');");
	
	$info = "Učet zaregistrován !";
	
}
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <title>Secret register</title>
 </head>
 <body>
  <form action="" method="post">
   <p>Jméno v minecraftu: <input type="text" name="mc-username"></p>
   <p>Uživatelské jméno: <input type="text" name="display-name"></p>
   <p>Email <input type="text" name="email"></p>
   <p>Heslo <input type="password" name="password"></p>
   <p><input type="submit" name="register"></p>
   <p><?php echo $info; ?></p>
  </form>
 </body>
</html>