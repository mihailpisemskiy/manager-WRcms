<?include("../_common/setup.php");
session_start();
$PHPSESSID = session_id();
if($_POST["logout"] == 'true'){
session_destroy();
header("Location: index.php");
exit;
}
if(!$_SESSION["uid"]) header("Location: index.php");

?>
<html>
<head>
	<title>[Manager Panel]</title>
	<LINK REL=stylesheet HREF="style.css" TYPE="text/css">
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
</head>
<body>
<h3 align="center">Welcome to Manager panel v1.0</h3>
<p align="left">
[+] Просмотр заявок<br>
[+] Поиск по номеру заявки<br>
[+] Печать заявок<br>
[+] Просмотр прайсов<br>
[+] Калькулятор расчёта стоимости перевозки<br>
 </p>
</body>
</html>
