<?
// открываем сессию
include("../_common/setup.php");


########################################################################################
## проверка имени пользователя, пароля, и раздача ему прав в зависимости от его UID
########################################################################################


	$q = "SELECT * FROM users WHERE Login = '".$_POST["login"]."' ";
//	echo $q;
	$q = sql($q);
	if(@mysql_num_rows($q) == 0 ) {
		header("Location: index.php?errcode=0");
//		echo "Такого пользователя не существует";
	} else {
		$row = mysql_fetch_object($q);
		if($row->PasswordHash == md5($_POST["pass"]))
		{
			$_SESSION["logged_user"] = $row->Login;
			$_SESSION["uid"] = $row->UserID;
			$_SESSION["email"] = $row->Email;
			$_SESSION["accessrights"] = $row->accessrights;
			$_SESSION["RootID"] = $row->RootID;
			sql("UPDATE users SET `\$lastlogin` = ".time()." WHERE UserID = ".$row->UserID);
			sql("INSERT INTO wr_log (UserID,ActionType,ActionTime) VALUES ('".$row->UserID."','Login','".time()."')");
			header("Location: main.php");
		} else {
			header("Location: index.php?errcode=1");
		}
	}
########################################################################################
## конец проверки юзера
########################################################################################

 ?>
