<?php
$form = "
<form method='post' target='zayavka_frame' action='../utils/visual_frame.php'>
<p><h3><u>����� �� ������ ������</u></h3></p>
<p><input type='text' name='zapr_post'>
<input type='submit' value='�����'></p>
</form>";
echo $form;
require_once("../_common/setup.php");
if(!$_SESSION["uid"]) header("Location: ../managers/index.php");
$zapr = $_GET['zapr'];
	$loadedPriceSQL = sql("SELECT * FROM zayavka ORDER BY ElementName DESC");
	$i=mysql_num_rows($loadedPriceSQL);//���������� �������
	///////////////////////////////////////////////////////////
	$loadedPriceSQL = sql("SELECT * FROM zayavka ORDER BY ElementName DESC LIMIT ".$zapr."");
		if(sql_n($loadedPriceSQL)>0)
		{
			echo '<table>';
			echo "<tr>
			<td align=left><strong>����� ������</strong></td>
			<td align=center><strong>�������</strong></td>";
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
				//echo "<a href='#' target='_self' onclick=change('zayavka".$loadedPrice['ElementName']."')>�����������</a>";
				echo "<a href='../utils/visual_frame.php?zapr=".$loadedPrice['ElementName']."' target='zayavka_frame')>�����������</a>";
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
	$a=0; //����� ��������
	$x=0; //� ������ �������� ��������
	//$limit - ������ $limit $a,$x
	$j=1; //$mass_str - ������ �������
	$b=25;//������� ��������� ��������
	$kol_str=0;//���-�� ������� � ������
	echo "��������<br>";
	while ($x<=$i)
	{
		$limit[$j] = $x.','.$b;//������ ��� LIMIT
		$mass_str[$j] = $j;
		$x=$x+$b; // ���������� ��������
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
