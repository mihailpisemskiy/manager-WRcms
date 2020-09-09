<?
include("../_common/setup.php");
if(!$_SESSION["uid"]) header("Location: index.php");
?>
<html>
<head>
	<title>Структура</title>
	<LINK REL=stylesheet HREF="style.css" TYPE="text/css">
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
	<style type="text/css">

   A.rollover1 {
    background: url(images/prosmotr_zayavok_oncover.jpg);
    display: block; 
    width: 124px; 
    height: 31px;
   }
   A.rollover1:hover {
	background: url(images/prosmotr_zayavok.jpg);
   }

      A.rollover2 {
    background: url(images/prosmotr_prisov_oncover.jpg);
    display: block; 
    width: 124px; 
    height: 31px;
   }
   A.rollover2:hover {
	background: url(images/prosmotr_prisov.jpg);
   }
   
      A.rollover3 {
    background: url(images/calc_oncover.jpg);
    display: block; 
    width: 124px; 
    height: 31px;
   }
   A.rollover3:hover {
	background: url(images/calc.jpg);
   }
   
      A.rollover4 {
    background: url(images/exit_oncover.jpg);
    display: block; 
    width: 124px; 
    height: 31px;
   }
   A.rollover4:hover {
	background: url(images/exit.jpg);
   }
   
  </style>
</head>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" <?if(isset($id)){echo 'onload="setTimeout(\'openTree('.$id.',0)\',400)"';};?>>
<script language="JavaScript">
<!--

function selectCross()
{
	Element = parent.mainFrame.document.getElementById("thisElementID");
	if(Element)
	{
		ElementID = Element.value;
		var elements = window.showModalDialog('itemscrossselector.php?ElementID=' + ElementID, "", "dialogHeight:320px;dialogWidth:470px;help:0;status:no;scroll:no;");
		if (elements[0] != -1)
		{
			var elstring = '';
			for (i = 0; i < elements.length; i++) elstring += '&iids[]=' + elements[i];
			document.location = 'itemscross.php?ElementID=' + ElementID + elstring;
		}
	}
}

//-->
</script>
<table border="0" cellspacing="0" cellpadding="0" width="100%"><colgroup><col span="6"></col> </colgroup>
<tbody>
<tr>
<td rowspan="2" width="8%"><div align="left"><br>&nbsp;Привет, <?=$_SESSION["logged_user"]?>! &nbsp; <span id="TimerText"></span> </div><br><img align="left" src="images/logo_mini.jpg" alt="Добро пожаловать" width="105" height="60" border="0"></td>
<td colspan="4" width="496"><img align="left" src="images/logo.jpg" alt="Добро пожаловать" width="140" height="41" border="0"></td>
<td rowspan="2" width="100%"></td>
</tr>
<tr>
<td width="124"><a href="/utils/zayavki_visual.php?zapr=0,25" target="mainFrame" class="rollover1"></a></td>
<td width="124"><a href="tarifs.php" target="mainFrame" class="rollover2"></a></td>
<td width="124"><a href="/utils/new_calc.php?otkuda1=Барнаул" target="mainFrame" class="rollover3"></a></td>
<td width="124"><a href="../managers/index.php?logout=true" target="mainFrame" class="rollover4"></a></td>
</tr>
</tbody>
</table>

</body>
</html>
