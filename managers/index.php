<?
include("../_common/setup.php");
?>
<html>
<head>
<title>[WR.cms] <?=$site['Name']?> LOGIN</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<LINK REL=stylesheet HREF="style.css" TYPE="text/css">
<script language="JavaScript">
<!--
if (window.parent.frames.length > 0) {
    top.location.href="/managers/";
}
function f(){
	document.getElementById('login').focus();
}
//-->
</script>
</head>

<body onload="f()">

<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><form name="form1" method="post" target="_top" action="authorize.php"><table  border="0" cellspacing="0" cellpadding="4">
		<col align="right">
			  <tr>
        <td colspan="2" align="right">
          <img src="images/logo.jpg" alt="Добро пожаловать" width="140" height="41" border="0">
        </td>
      </tr>
		<tr>
        <td colspan="2" align="right">
          <img src="images/logo_tes.jpg" alt="Добро пожаловать" width="374" height="60" border="0">
        </td>
      </tr>
	<?
	$err = Array();
	$err[0] = 'Неверный пользователь';
	$err[1] = 'Неверный пароль';
	if(isset($_GET[errcode]))
	{
		echo '<tr><td colspan="2" align="center"><b>'.$err[$_GET[errcode]].'</b></td></tr>';
	} else {
	  	echo '<tr><td colspan="2" align="center">&nbsp;</td></tr>';
	}
	?>
	  <tr>
        <td>Логин:</td>
        <td>
          <input name="login" type="text" id="login">
        </td>
      </tr>
      <tr>
        <td>Пароль:</td>
        <td><input name="pass" type="password" id="pass"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="Submit" type="image" src="images/enter.jpg" style="width:124px;height:31px;border:none;" id="Submit" class="btn" value="Enter"></td>
      </tr>
    </table></form>
	
	<p align="center" style="color:#000000; font-size:10px; text-decoration:none;"><?=date('Y')?> coded by Solv, specially for tesgroup.ru</p></td>
  </tr>
</table>
</body>
</html>
