<script>
///////////////СКРЫТЫЙ ЭЛЕМЕНТ///////////////////////
function change(idName) {
  if(document.getElementById(idName).style.display=='none') {
    document.getElementById(idName).style.display = '';
  } else {
    document.getElementById(idName).style.display = 'none';
  }
  return false;
}
</script>
<?php
include("../_common/setup.php");
if(!$_SESSION["uid"]) header("Location: ../managers/index.php");
//require_once("../_common/setup.php");
include 'a.charset.php';
$gorod_otkuda = $_GET['otkuda']; 
$gorod_kuda = $_GET['kuda'];
mysql_select_db("tescompany_db");

$query = 'SELECT ArrivalName FROM prices GROUP BY ArrivalName ORDER BY ArrivalName ASC';
$results = mysql_query($query);

//echo "<center>";
echo "<select onchange='document.location=this.options[this.selectedIndex].value'>\n";
echo "<name>\n";
echo "<option>Выберите город</option>";
while ($line = mysql_fetch_assoc($results)) {
 echo "<option value='tarifs.php?otkuda=".$line["ArrivalName"]."'>".$line["ArrivalName"]."</option>\n";
 }
 echo "</select>\n";
//echo "</center>";
echo "<br>";
//echo "<a href='#' onclick=change('test')><h3>Тарифы по весу (руб/кг) из г.".$gorod_otkuda."</h3></a>";
$query = 'SELECT * FROM prices WHERE DepartureName="'.$gorod_otkuda.'" ORDER BY ArrivalName ASC';
if (mb_check_encoding($query, 'UTF-8') && !mb_check_encoding($query, 'Windows-1251'))
        $query = mb_convert_encoding($query, 'Windows-1251', 'UTF-8');
$results = mysql_query($query);

$query_filial = 'SELECT * FROM filial_info WHERE filial="'.$gorod_otkuda.'"';
$results_filial = mysql_query($query_filial);
//////////////////////////////////////////////////////////////////////////////////////////////////
$onprint = "<br>"."<table width=100% align=center border=1 cellspacing=0 cellpadding=0><tbody>\n";
  while ($line_filial = mysql_fetch_assoc($results_filial)) {
$onprint .="<tr>"."<td colspan=4 align=left><h3>&nbsp;".$line_filial["filial_name"]."</h3>&nbsp;Действует с ".$line_filial["actual_date_v"]."</td>"."<td colspan=15 align=right>".$line_filial["tel_number"]."<br>".$line_filial["email"]."</td>"."</tr>";
$onprint_for_all = "<tr>"."<td colspan=4 align=left><h3>&nbsp;".$line_filial["filial_name"]."</h3>&nbsp;Действует с ".$line_filial["actual_date_v"]."</td>"."<td colspan=15 align=right>".$line_filial["tel_number"]."<br>".$line_filial["email"]."</td>"."</tr>";
}
///////////////////////////////////////////////////////////////////////
///////////ДЛЯ РАСПЕЧАТКИ//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
$onprint .="<tr>"."<td colspan=19 align=center><center><h3>Прайс-лист на перевозку сборных грузов из г.".$gorod_otkuda."\n</h3></center></td>"."</tr>"."<tr>"."<td rowspan=2 align=center><strong>В город</strong></td>"."<td rowspan=2 align=center><strong>Тип <br>ТС</strong></td>"."<td rowspan=2 align=center><strong>Мин.<br>стоим.</strong></td>"."<td align=center colspan=16><strong>Тарифы по весу (руб/кг)</strong></td>"."</tr>"."<tr>"."<td align=center><strong><500</strong></td>"."<td align=center><strong>500</strong></td>"."<td align=center><strong>1000</strong></td>"."<td align=center><strong>2000</strong></td>"."<td align=center><strong>3000</strong></td>"."<td align=center><strong>4000</strong></td>"."<td align=center><strong>5000</strong></td>"."<td align=center><strong>6000</strong></td>"."<td align=center><strong>7000</strong></td>"."<td align=center><strong>8000</strong></td>"."<td align=center><strong>9000</strong></td>"."<td align=center><strong>10000</strong></td>"."<td align=center><strong>15000</strong></td>"."<td align=center><strong>20000</strong></td>"."<td align=center><strong>25000</strong></td>"."<td align=center><strong>30000</strong></td>"."</tr>";
///////////////////////////////////////////////////////////////////////
$query_filial = 'SELECT * FROM filial_info WHERE filial="'.$gorod_otkuda.'"';
$results_filial = mysql_query($query_filial);

$i=0; $shapka_1 = true; $table_end=false;
$color_td="#FFFFFF";
while ($line = mysql_fetch_assoc($results)) {
if ($shapka_1 == true)
{
echo "<a href='#' onclick=change('test')><h3>Тарифы по весу (руб/кг) из г.".$gorod_otkuda."</h3></a>";
echo "<div style='display:none' id='test'>";
echo "<table width= 100% align=center border=1 cellspacing=0 cellpadding=0><tbody>\n";
  while ($line_filial = mysql_fetch_assoc($results_filial)) {
echo "<tr>";
echo "<td colspan=4 align=left><h3>&nbsp;".$line_filial["filial_name"]."</h3>&nbsp;Действует с ".$line_filial["actual_date_v"]."</td>";
echo "<td colspan=15 align=right>".$line_filial["tel_number"]."<br>".$line_filial["email"]."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td colspan=19 align=center><center><h3>Прайс-лист на перевозку сборных грузов из г.".$gorod_otkuda."\n</h3></center></td>";
echo "</tr>";

echo "<tr>";
echo "<td rowspan=2 width=120 align=center><strong>В город</strong></td>";
echo "<td rowspan=2 align=center><strong>Тип <br>ТС</strong></td>";
echo "<td rowspan=2 align=center><strong>Мин.<br>стоим.</strong></td>";
echo "<td align=center colspan=16><strong>Тарифы по весу (руб/кг)</strong></td>";
echo "</tr>";
echo "<tr>";
echo "<td align=center><strong><500</strong></td>";
echo "<td align=center><strong>500</strong></td>";
echo "<td align=center><strong>1000</strong></td>";
echo "<td align=center><strong>2000</strong></td>";
echo "<td align=center><strong>3000</strong></td>";
echo "<td align=center><strong>4000</strong></td>";
echo "<td align=center><strong>5000</strong></td>";
echo "<td align=center><strong>6000</strong></td>";
echo "<td align=center><strong>7000</strong></td>";
echo "<td align=center><strong>8000</strong></td>";
echo "<td align=center><strong>9000</strong></td>";
echo "<td align=center><strong>10000</strong></td>";
echo "<td align=center><strong>15000</strong></td>";
echo "<td align=center><strong>20000</strong></td>";
echo "<td align=center><strong>25000</strong></td>";
echo "<td align=center><strong>30000</strong></td>";
echo "</tr>";
$shapka_1=false;
}
 if (fmod($i,2) == 0)
 {
 $color_td="#D3D1D8";
 } 
 else 
 {$color_td ="#FFFFFF";}
 echo "<tr>";
 echo "<td bgcolor=".$color_td." >".$line["ArrivalName"]."</td>"."<td bgcolor=".$color_td."  align=center>".$line["VagonType"]."\n"."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["minkg"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_200"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_500"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_1000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_2000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_3000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_4000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_5000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_6000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_7000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_8000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_9000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_1000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_15000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_20000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_25000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_30000"]."</td>";
 echo "</tr>";
 $onprint .="<tr>"."<td bgcolor=".$color_td.">".$line["ArrivalName"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["VagonType"]."\n"."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["minkg"])."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_200"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_500"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_1000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_2000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_3000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_4000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_5000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_6000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_7000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_8000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_9000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_1000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_15000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_20000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_25000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_30000"]."</td>"."</tr>";
 $i++;
 $table_end = true;
 }
 if ($table_end == true) {
////////////ПРИМЕЧАНИЕ ОБЩЕЕ///////////////////////////////////////
		echo "</tbody></table>";
	
// echo "</tbody></table>";
 }
 //$onprint .="</tbody></table>";
echo  "</div>";
 /////////////////////////////////ОБЪЁМ////////////////////////////////
$shapka_2=true; $i=0; $table_end=false;
$query = 'SELECT * FROM prices WHERE DepartureName="'.$gorod_otkuda.'" ORDER BY ArrivalName ASC';
$results = mysql_query($query);
///////////////////////////////////////////////////////////////////
///////////////////////////ДЛЯ РАСПЕЧАТКИ//////////////////////////
///////////////////////////////////////////////////////////////////
$onprint .= "<br><br><table width=100% align=center border=1 cellspacing=0 cellpadding=0><tbody>".$onprint_for_all."<tr>"."<td colspan=19 align=center><center><h3>Прайс-лист на перевозку сборных грузов из г.".$gorod_otkuda."\n</h3></center></td>"."</tr>"."<tr>"."<td rowspan=2 align=center><strong>В город</strong></td>"."<td rowspan=2 align=center><strong>Тип<br> ТС</strong></td>"."<td rowspan=2 align=center><strong>Мин.<br>стоим.</strong></td>"."<td align=center colspan=16><strong>Тарифы по объему (руб/м3)</strong></td>"."</tr>"."<tr>"."<td align=center><strong><1</strong></td>"."<td align=center><strong>1</strong></td>"."<td align=center><strong>2</strong></td>"."<td align=center><strong>4</strong></td>"."<td align=center><strong>6</strong></td>"."<td align=center><strong>8</strong></td>"."<td align=center><strong>10</strong></td>"."<td align=center><strong>12</strong></td>"."<td align=center><strong>14</strong></td>"."<td align=center><strong>16</strong></td>"."<td align=center><strong>18</strong></td>"."<td align=center><strong>20</strong></td>"."<td align=center><strong>30</strong></td>"."<td align=center><strong>40</strong></td>"."<td align=center><strong>50</strong></td>"."<td align=center><strong>60</strong></td>"."</tr>";
///////////////////////////////////////////////////////////////////
$query_filial = 'SELECT * FROM filial_info WHERE filial="'.$gorod_otkuda.'"';
$results_filial = mysql_query($query_filial);
while ($line = mysql_fetch_assoc($results)) {
if ($shapka_2 == true)
{
echo "<a href='#' onclick=change('test1')><h3>Тарифы по объему (руб/м3) из г.".$gorod_otkuda."</h3></a>";
echo "<div style='display:none' id='test1'>";
echo "<br><table width=100% align=center border=1 cellspacing=0 cellpadding=0><tbody>\n";
  while ($line_filial = mysql_fetch_assoc($results_filial)) {
echo "<tr>";
echo "<td colspan=4 align=left><h3>&nbsp;".$line_filial["filial_name"]."</h3>&nbsp;Действует с ".$line_filial["actual_date_v"]."</td>";
echo "<td colspan=15 align=right>".$line_filial["tel_number"]."<br>".$line_filial["email"]."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td colspan=19 align=center><center><h3>Прайс-лист на перевозку сборных грузов из г.".$gorod_otkuda."\n</h3></center></td>";
echo "</tr>";
echo "<tr>";
echo "<td rowspan=2 width=120 align=center><strong>В город</strong></td>";
echo "<td rowspan=2 align=center><strong>Тип<br> ТС</strong></td>";
echo "<td rowspan=2 align=center><strong>Мин.<br>стоим.</strong></td>";
echo "<td align=center colspan=16><strong>Тарифы по объему (руб/м3)</strong></td>";
echo "</tr>";
echo "<tr>";
echo "<td align=center><strong><1</strong></td>";
echo "<td align=center><strong>1</strong></td>";
echo "<td align=center><strong>2</strong></td>";
echo "<td align=center><strong>4</strong></td>";
echo "<td align=center><strong>6</strong></td>";
echo "<td align=center><strong>8</strong></td>";
echo "<td align=center><strong>10</strong></td>";
echo "<td align=center><strong>12</strong></td>";
echo "<td align=center><strong>14</strong></td>";
echo "<td align=center><strong>16</strong></td>";
echo "<td align=center><strong>18</strong></td>";
echo "<td align=center><strong>20</strong></td>";
echo "<td align=center><strong>30</strong></td>";
echo "<td align=center><strong>40</strong></td>";
echo "<td align=center><strong>50</strong></td>";
echo "<td align=center><strong>60</strong></td>";
echo "</tr>";
$shapka_2=false;
}
//////////////////////////////////////////////////////////
if (fmod($i,2) == 0)
 {
 $color_td="#D3D1D8";
 } 
 else 
 {$color_td ="#FFFFFF";}
echo "<tr>";
echo "<td bgcolor=".$color_td.">".$line["ArrivalName"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["VagonType"]."\n"."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["minkub"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_0_4"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_1"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_2"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_4"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_6"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_8"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_10"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_12"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_14"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_16"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_18"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_20"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_30"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_40"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_50"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_60"])."</td>";
 echo "</tr>";
$onprint .="<tr>"."<td bgcolor=".$color_td.">".$line["ArrivalName"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["VagonType"]."\n"."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["minkub"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_0_4"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_1"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_2"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_4"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_6"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_8"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_10"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_12"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_14"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_16"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_18"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_20"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_30"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_40"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_50"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_60"])."</td>"."</tr>";
$i++;
$table_end = true;
}
if ($table_end == true){
$query_note = 'SELECT note_all FROM filial_info WHERE filial="Москва"';
$results_note = mysql_query($query_note);

	while ($line_note = mysql_fetch_assoc($results_note)) 
	{
		echo "</tbody></table>";
		//echo "<tr>";
		//echo $line_note["note_all"];
		//echo "</tr>";
		$onprint .="</tbody></table>".$line_note["note_all"];
	}
	
	$query_note = 'SELECT * FROM filial_info WHERE filial="'.$gorod_otkuda.'"';
	$results_note = mysql_query($query_note);

	while ($line_note = mysql_fetch_assoc($results_note)) 
	{
		//echo "</tbody></table>";
		//echo "<tr>";
		//echo $line_note["note_iz"];
		//echo "</tr>";
		$onprint .=$line_note["note_iz"];
	}
//$onprint .= "</tbody></table>";
}
 //echo $onprint;
 ////////////////////////////////GET///////////////////////////
 //echo "<a href='http://localhost/lol.php?output=".$onprint."'>Сохранить прайс в excel формате</a>";
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////POST/////////
 echo "<br><br></div>";
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//mysql_close($link);
/*
$query = 'SELECT * FROM price,filial_info';
$results = mysql_query($query);

while ($line = mysql_fetch_assoc($results)) {
 //echo $line["DepartureName"]."<br>";
 echo $line["filial"];
 echo "____<br>";
 }
*/
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ГОРОД КУДА "В"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$query = 'SELECT DepartureName FROM prices GROUP BY DepartureName ORDER BY DepartureName ASC';
$results = mysql_query($query);

//echo "<a href='#' onclick=change('test')><h3>Тарифы по весу (руб/кг) из г.".$gorod_otkuda."</h3></a>";
$query = 'SELECT * FROM prices WHERE ArrivalName="'.$gorod_otkuda.'" ORDER BY DepartureName ASC';
if (mb_check_encoding($query, 'UTF-8') && !mb_check_encoding($query, 'Windows-1251'))
        $query = mb_convert_encoding($query, 'Windows-1251', 'UTF-8');
$results = mysql_query($query);

$query_filial = 'SELECT * FROM filial_info WHERE filial="'.$gorod_otkuda.'"';
$results_filial = mysql_query($query_filial);
//////////////////////////////////////////////////////////////////////////////////////////////////
$onprint .= "<br>"."<table width=100% align=center border=1 cellspacing=0 cellpadding=0><tbody>\n";
  while ($line_filial = mysql_fetch_assoc($results_filial)) {
$onprint .="<tr>"."<td colspan=4 align=left><h3>&nbsp;".$line_filial["filial_name"]."</h3>&nbsp;Действует с ".$line_filial["actual_date_v"]."</td>"."<td colspan=15 align=right>".$line_filial["tel_number"]."<br>".$line_filial["email"]."</td>"."</tr>";
$onprint_for_all = "<tr>"."<td colspan=4 align=left><h3>&nbsp;".$line_filial["filial_name"]."</h3>&nbsp;Действует с ".$line_filial["actual_date_v"]."</td>"."<td colspan=15 align=right>".$line_filial["tel_number"]."<br>".$line_filial["email"]."</td>"."</tr>";
}
///////////////////////////////////////////////////////////////////////
///////////ДЛЯ РАСПЕЧАТКИ//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
$onprint .="<tr>"."<td colspan=19 align=center><center><h3>Прайс-лист на перевозку сборных грузов в г.".$gorod_otkuda."\n</h3></center></td>"."</tr>"."<tr>"."<td rowspan=2 align=center><strong>В город</strong></td>"."<td rowspan=2 align=center><strong>Тип <br>ТС</strong></td>"."<td rowspan=2 align=center><strong>Мин.<br>стоим.</strong></td>"."<td align=center colspan=16><strong>Тарифы по весу (руб/кг)</strong></td>"."</tr>"."<tr>"."<td align=center><strong><500</strong></td>"."<td align=center><strong>500</strong></td>"."<td align=center><strong>1000</strong></td>"."<td align=center><strong>2000</strong></td>"."<td align=center><strong>3000</strong></td>"."<td align=center><strong>4000</strong></td>"."<td align=center><strong>5000</strong></td>"."<td align=center><strong>6000</strong></td>"."<td align=center><strong>7000</strong></td>"."<td align=center><strong>8000</strong></td>"."<td align=center><strong>9000</strong></td>"."<td align=center><strong>10000</strong></td>"."<td align=center><strong>15000</strong></td>"."<td align=center><strong>20000</strong></td>"."<td align=center><strong>25000</strong></td>"."<td align=center><strong>30000</strong></td>"."</tr>";
///////////////////////////////////////////////////////////////////////
$query_filial = 'SELECT * FROM filial_info WHERE filial="'.$gorod_otkuda.'"';
$results_filial = mysql_query($query_filial);

$i=0; $shapka_1 = true; $table_end=false;
$color_td="#FFFFFF";
while ($line = mysql_fetch_assoc($results)) {
if ($shapka_1 == true)
{
echo "<a href='#' onclick=change('test3')><h3>Тарифы по весу (руб/кг) в г.".$gorod_otkuda."</h3></a>";
echo "<div style='display:none' id='test3'>";
echo "<table width= 100% align=center border=1 cellspacing=0 cellpadding=0><tbody>\n";
  while ($line_filial = mysql_fetch_assoc($results_filial)) {
echo "<tr>";
echo "<td colspan=4 align=left><h3>&nbsp;".$line_filial["filial_name"]."</h3>&nbsp;Действует с ".$line_filial["actual_date_v"]."</td>";
echo "<td colspan=15 align=right>".$line_filial["tel_number"]."<br>".$line_filial["email"]."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td colspan=19 align=center><center><h3>Прайс-лист на перевозку сборных грузов в г.".$gorod_otkuda."\n</h3></center></td>";
echo "</tr>";

echo "<tr>";
echo "<td rowspan=2 width=120 align=center><strong>Из города</strong></td>";
echo "<td rowspan=2 align=center><strong>Тип <br>ТС</strong></td>";
echo "<td rowspan=2 align=center><strong>Мин.<br>стоим.</strong></td>";
echo "<td align=center colspan=16><strong>Тарифы по весу (руб/кг)</strong></td>";
echo "</tr>";
echo "<tr>";
echo "<td align=center><strong><500</strong></td>";
echo "<td align=center><strong>500</strong></td>";
echo "<td align=center><strong>1000</strong></td>";
echo "<td align=center><strong>2000</strong></td>";
echo "<td align=center><strong>3000</strong></td>";
echo "<td align=center><strong>4000</strong></td>";
echo "<td align=center><strong>5000</strong></td>";
echo "<td align=center><strong>6000</strong></td>";
echo "<td align=center><strong>7000</strong></td>";
echo "<td align=center><strong>8000</strong></td>";
echo "<td align=center><strong>9000</strong></td>";
echo "<td align=center><strong>10000</strong></td>";
echo "<td align=center><strong>15000</strong></td>";
echo "<td align=center><strong>20000</strong></td>";
echo "<td align=center><strong>25000</strong></td>";
echo "<td align=center><strong>30000</strong></td>";
echo "</tr>";
$shapka_1=false;
}
 if (fmod($i,2) == 0)
 {
 $color_td="#D3D1D8";
 } 
 else 
 {$color_td ="#FFFFFF";}
 echo "<tr>";
 echo "<td bgcolor=".$color_td." >".$line["DepartureName"]."</td>"."<td bgcolor=".$color_td."  align=center>".$line["VagonType"]."\n"."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["minkg"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_200"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_500"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_1000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_2000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_3000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_4000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_5000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_6000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_7000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_8000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_9000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_1000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_15000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_20000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_25000"]."</td>"
 ."<td bgcolor=".$color_td." align=center>".$line["kg_30000"]."</td>";
 echo "</tr>";
 $onprint .="<tr>"."<td bgcolor=".$color_td.">".$line["DepartureName"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["VagonType"]."\n"."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["minkg"])."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_200"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_500"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_1000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_2000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_3000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_4000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_5000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_6000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_7000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_8000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_9000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_1000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_15000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_20000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_25000"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["kg_30000"]."</td>"."</tr>";
 $i++;
 $table_end = true;
 }
 if ($table_end == true) {
////////////ПРИМЕЧАНИЕ ОБЩЕЕ///////////////////////////////////////
		echo "</tbody></table>";
	
// echo "</tbody></table>";
 }
 //$onprint .="</tbody></table>";
echo  "</div>";
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 /////////////////////////////////ОБЪЁМ////////////////////////////////
$shapka_2=true; $i=0; $table_end=false;
$query = 'SELECT * FROM prices WHERE ArrivalName="'.$gorod_otkuda.'" ORDER BY DepartureName ASC';
$results = mysql_query($query);
///////////////////////////////////////////////////////////////////
///////////////////////////ДЛЯ РАСПЕЧАТКИ//////////////////////////
///////////////////////////////////////////////////////////////////
$onprint .= "<br><br><table width=100% align=center border=1 cellspacing=0 cellpadding=0><tbody>".$onprint_for_all."<tr>"."<td colspan=19 align=center><center><h3>Прайс-лист на перевозку сборных грузов в г.".$gorod_otkuda."\n</h3></center></td>"."</tr>"."<tr>"."<td rowspan=2 align=center><strong>В город</strong></td>"."<td rowspan=2 align=center><strong>Тип<br> ТС</strong></td>"."<td rowspan=2 align=center><strong>Мин.<br>стоим.</strong></td>"."<td align=center colspan=16><strong>Тарифы по объему (руб/м3)</strong></td>"."</tr>"."<tr>"."<td align=center><strong><1</strong></td>"."<td align=center><strong>1</strong></td>"."<td align=center><strong>2</strong></td>"."<td align=center><strong>4</strong></td>"."<td align=center><strong>6</strong></td>"."<td align=center><strong>8</strong></td>"."<td align=center><strong>10</strong></td>"."<td align=center><strong>12</strong></td>"."<td align=center><strong>14</strong></td>"."<td align=center><strong>16</strong></td>"."<td align=center><strong>18</strong></td>"."<td align=center><strong>20</strong></td>"."<td align=center><strong>30</strong></td>"."<td align=center><strong>40</strong></td>"."<td align=center><strong>50</strong></td>"."<td align=center><strong>60</strong></td>"."</tr>";
///////////////////////////////////////////////////////////////////
$query_filial = 'SELECT * FROM filial_info WHERE filial="'.$gorod_otkuda.'"';
$results_filial = mysql_query($query_filial);
while ($line = mysql_fetch_assoc($results)) {
if ($shapka_2 == true)
{
echo "<a href='#' onclick=change('test4')><h3>Тарифы по объему (руб/м3) в г.".$gorod_otkuda."</h3></a>";
echo "<div style='display:none' id='test4'>";
echo "<br><table width=100% align=center border=1 cellspacing=0 cellpadding=0><tbody>\n";
  while ($line_filial = mysql_fetch_assoc($results_filial)) {
echo "<tr>";
echo "<td colspan=4 align=left><h3>&nbsp;".$line_filial["filial_name"]."</h3>&nbsp;Действует с ".$line_filial["actual_date_v"]."</td>";
echo "<td colspan=15 align=right>".$line_filial["tel_number"]."<br>".$line_filial["email"]."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td colspan=19 align=center><center><h3>Прайс-лист на перевозку сборных грузов в г.".$gorod_otkuda."\n</h3></center></td>";
echo "</tr>";
echo "<tr>";
echo "<td rowspan=2 width=120 align=center><strong>Из города</strong></td>";
echo "<td rowspan=2 align=center><strong>Тип<br> ТС</strong></td>";
echo "<td rowspan=2 align=center><strong>Мин.<br>стоим.</strong></td>";
echo "<td align=center colspan=16><strong>Тарифы по объему (руб/м3)</strong></td>";
echo "</tr>";
echo "<tr>";
echo "<td align=center><strong><1</strong></td>";
echo "<td align=center><strong>1</strong></td>";
echo "<td align=center><strong>2</strong></td>";
echo "<td align=center><strong>4</strong></td>";
echo "<td align=center><strong>6</strong></td>";
echo "<td align=center><strong>8</strong></td>";
echo "<td align=center><strong>10</strong></td>";
echo "<td align=center><strong>12</strong></td>";
echo "<td align=center><strong>14</strong></td>";
echo "<td align=center><strong>16</strong></td>";
echo "<td align=center><strong>18</strong></td>";
echo "<td align=center><strong>20</strong></td>";
echo "<td align=center><strong>30</strong></td>";
echo "<td align=center><strong>40</strong></td>";
echo "<td align=center><strong>50</strong></td>";
echo "<td align=center><strong>60</strong></td>";
echo "</tr>";
$shapka_2=false;
}
//////////////////////////////////////////////////////////
if (fmod($i,2) == 0)
 {
 $color_td="#D3D1D8";
 } 
 else 
 {$color_td ="#FFFFFF";}
echo "<tr>";
echo "<td bgcolor=".$color_td.">".$line["DepartureName"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["VagonType"]."\n"."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["minkub"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_0_4"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_1"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_2"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_4"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_6"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_8"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_10"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_12"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_14"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_16"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_18"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_20"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_30"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_40"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_50"])."</td>"
 ."<td bgcolor=".$color_td." align=center>".ceil($line["kub_60"])."</td>";
 echo "</tr>";
$onprint .="<tr>"."<td bgcolor=".$color_td.">".$line["DepartureName"]."</td>"."<td bgcolor=".$color_td." align=center>".$line["VagonType"]."\n"."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["minkub"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_0_4"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_1"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_2"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_4"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_6"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_8"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_10"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_12"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_14"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_16"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_18"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_20"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_30"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_40"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_50"])."</td>"."<td bgcolor=".$color_td." align=center>".ceil($line["kub_60"])."</td>"."</tr>";
$i++;
$table_end = true;
}
if ($table_end == true){
$query_note = 'SELECT note_all FROM filial_info WHERE filial="Москва"';
$results_note = mysql_query($query_note);

	while ($line_note = mysql_fetch_assoc($results_note)) 
	{
		echo "</tbody></table>";
		//echo "<tr>";
		//echo $line_note["note_all"];
		//echo "</tr>";
		$onprint .="</tbody></table>".$line_note["note_all"];
	}
	
	$query_note = 'SELECT * FROM filial_info WHERE filial="'.$gorod_otkuda.'"';
	$results_note = mysql_query($query_note);

	while ($line_note = mysql_fetch_assoc($results_note)) 
	{
		//echo "</tbody></table>";
		//echo "<tr>";
		//echo $line_note["note_iz"];
		//echo "</tr>";
		$onprint .=$line_note["note_v"];
	}
}
 echo "<br><br></div>";
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
/*
 if ($table_end == true) {
 echo "
<form align=left name='form1' method='post' action='http://tesgrup.ru/my_tpl/download.php'>
<div style='display:none' id='test'><textarea hidden='true' name='text' cols='80' rows='10'>".$onprint."</textarea></div>
<input type='image' width='40' src='http://tesgrup.ru/my_tpl/excel.jpg' name='form1' type='submit' value='Сохранить прайс в excel формате'/>
<input name='form1' type='submit' value='Скачать'/>
</form>";
echo "<br>";
}*/
?>
</div>