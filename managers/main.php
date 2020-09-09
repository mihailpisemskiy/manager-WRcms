<?
include("../_common/setup.php");
if(!$_SESSION["uid"]) header("Location: index.php");
?><html>
<head>
	<title>[WR.cms] <?=$site['Name']?></title>
	<LINK REL=stylesheet HREF="style.css" TYPE="text/css">
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
</head>

<!--<frameset cols="250,*" frameborder="no" border="0" framespacing="0">
  <frame src="tree.php" name="TreeFrame" scrolling="yes" noresize>
  <frame src="welcome.php" name="mainFrame" scrolling="yes">
</frameset>-->
 <frameset rows="140,*" cols="*">
   <frame src="tree.php" name="TreeFrame" scrolling="no" noresize>
   <frameset cols="50%,*">
	<frame src="welcome.php" name="mainFrame">
    <frame src="../utils/visual_frame.php" name="zayavka_frame" scrolling="yes">
   </frameset>
 </frameset>
</html>
