<?php
$form = "
<form method='post' target='zayavka_frame' action='../utils/visual_frame.php'>
<p><h3><u>ПОИСК ПО НОМЕРУ ЗАЯВКИ</u></h3></p>
<p><input type='text' name='zapr_post'>
<input type='submit' value='Найти'></p>
</form>";
echo $form;
require_once("../_common/setup.php");
if(!$_SESSION["uid"]) header("Location: ../managers/index.php");
$zapr = $_GET['zapr'];
	$loadedPriceSQL = sql("SELECT * FROM zayavka ORDER BY ElementName DESC");
	$i=mysql_num_rows($loadedPriceSQL);//количество записей
	///////////////////////////////////////////////////////////
	$loadedPriceSQL = sql("SELECT * FROM zayavka ORDER BY ElementName DESC LIMIT ".$zapr."");
		if(sql_n($loadedPriceSQL)>0)
		{
			echo '<table>';
			echo "<tr>
			<td align=left><strong>Номер заявки</strong></td>
			<td align=center><strong>Создана</strong></td>";
			echo "</tr>";
			while($loadedPrice = sql_a($loadedPriceSQL))
			{
				echo '<tr>';
				echo '<td>';
				echo "<center>".$loadedPrice['ElementName']."</center>";
				echo '</td>';
				echo '<td>';
				echo date( 'H\hi d F Y', $loadedPrice['$created'] );
				//$date_time_array = getdate( $loadedPrice['$created'] );
				//,'minutes','mday','month','year','dyear'
				//echo $date_time_array['hours'].":".$date_time_array['minutes']." | ".$date_time_array['mday']." ".$date_time_array['month']." ".$date_time_array['year'];
				echo '</td>';
				echo '<td>';
				//echo "<a href='#' target='_self' onclick=change('zayavka".$loadedPrice['ElementName']."')>Просмотреть</a>";
				echo "<a href='../utils/visual_frame.php?zapr=".$loadedPrice['ElementName']."' target='zayavka_frame')>Просмотреть</a>";
				echo '</td>';
				echo "<td></td>";
				echo '</tr>';
				//echo '<tr>';
				//echo '<td colspan=3>';
				//echo "<div style='display:none' id='zayavka".$loadedPrice['ElementName']."'>".$loadedPrice['descr']." </div>";
				//echo '</td>';
				//echo '</tr>';
				//print_r($loadedPrice);
			}
			echo "</table>";
		}
	//////////////////////////////////////////////////////////////////
	$a=0; //номер страницы
	$x=0; //с какого элемента выводить
	//$limit - массив $limit $a,$x
	$j=1; //$mass_str - массив страниц
	$b=25;//сколько элементов выводить
	$kol_str=0;//кол-во страниц в строке
	echo "Страницы<br>";
	while ($x<=$i)
	{
		$limit[$j] = $x.','.$b;//массив для LIMIT
		$mass_str[$j] = $j;
		$x=$x+$b; // Увеличение счетчика
		echo "<a href='/utils/zayavki_visual.php?zapr=".$limit[$j]."' target='mainFrame'>".$j."</a>";
		if ($x<=$i){
		echo ",";
		}
		//$limit[$j]
		$j++;
		//echo $x;
		if ($kol_str == 30)
		{
		  $kol_str=0;
		  echo "<br>";
		}
		$kol_str++;
	}
?>
