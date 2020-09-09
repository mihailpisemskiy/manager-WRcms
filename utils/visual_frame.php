<?php
require_once("../_common/setup.php");
if(!$_SESSION["uid"]) header("Location: ../managers/index.php");
$zapr = $_GET['zapr'];
$zapr1 = $_POST['zapr_post'];
///////////////////////////////////////////////////////////
$loadedPriceSQL = sql("SELECT * FROM zayavka WHERE ElementName='".$zapr."' ");
	if(sql_n($loadedPriceSQL)>0)
	{
		while($loadedPrice = sql_a($loadedPriceSQL))
		{
			echo $loadedPrice["descr"];
		}
	echo "<button onclick='window.print();window.close();'>Распечатать</button>";
	}
$loadedPriceSQL = sql("SELECT * FROM zayavka WHERE ElementName='".$zapr1."' ");
	if(sql_n($loadedPriceSQL)>0)
	{
		while($loadedPrice = sql_a($loadedPriceSQL))
		{
			echo $loadedPrice["descr"];
		}
	echo "<button onclick='window.print();window.close();'>Распечатать</button>";
	}		
?>