<?php
require_once("../_common/setup.php");
if(!$_SESSION["uid"]) header("Location: ../managers/index.php");
$kg=0; $ob=0;
$kg = $_POST['kg'];
$ob = $_POST['ob'];
$gorod_otkuda = $_POST[otkuda]; $gorod_kuda = $_POST[kuda];
$gorod_otkuda1 = $_GET[otkuda1];
//���
$kg_base = array(1=>200,2=>500,3=>1000,4=>2000,5=>3000,6=>4000,7=>5000,8=>6000,9=>7000,10=>8000,11=>9000,12=>10000,13=>15000,14=>20000,15=>25000,16=>30000);
//�����
$ob_base = array(1=>0.4,2=>1,3=>2,4=>4,5=>6,6=>8,7=>10,8=>12,9=>14,10=>16,11=>18,12=>20,13=>30,14=>40,15=>50,16=>60);
/////////////////////////////////////////////////////////////////////////////////////////////
echo "<p><b>�������� ��������� ��� �������:</b></p>";
//$link = mysql_connect ("localhost", "root", ""); // ������������ � ����
//mysql_select_db("tes"); // �������� ����
?>
<form method="post" action='../utils/new_calc.php'>
<table border="0" cellspacing="0" cellpadding="0" width="292"><colgroup> <col width="137"></col> <col width="155"></col> </colgroup>
<tbody>
<tr height="20">
<td align=left width="137" height="20" align="left">
<?
$query = 'SELECT DepartureName FROM prices GROUP BY DepartureName ORDER BY DepartureName ASC';
$results = mysql_query($query);

echo "����� �����������:<select name='otkuda' onchange='document.location=this.options[this.selectedIndex].value'><br>";
echo "<name>\n";
if (isset($gorod_otkuda1))
{
echo "<option>" .$gorod_otkuda1. "</option>";
}
else
{
echo "<option>" .$gorod_otkuda. "</option>";
}
while ($line = mysql_fetch_assoc($results)) {
 echo "<option value='new_calc.php?otkuda1=".$line["DepartureName"]."'>" .$line["DepartureName"] . "</option>\n";
 }
 echo "</select><br>";
 ?>
</td>
<td width="155" align="left">�����(��):<input type="text" name="kg" value="<? echo $kg; ?>"></td>
</tr>
<tr height="20">
<td height="20" align="left"><?
if (isset($gorod_otkuda1)){
$query = 'SELECT ArrivalName FROM prices WHERE DepartureName="'.$gorod_otkuda1.'" GROUP BY ArrivalName ORDER BY ArrivalName ASC';}
else
{
$query = 'SELECT ArrivalName FROM prices WHERE DepartureName="�������" GROUP BY ArrivalName ORDER BY ArrivalName ASC';
}
$results = mysql_query($query);
echo "����� ��������:<br><select name='kuda'><br>";
echo "<name>\n";
if (isset($gorod_kuda))
{
echo "<option>" .$gorod_kuda. "</option>";
}
while ($line = mysql_fetch_assoc($results)) {
 echo "<option>" .$line["ArrivalName"] . "</option>\n";
 }
 echo "</select><br>";
 ?></td>
<td align="left">�����(�3):<input type="text" name="ob" value="<? echo $ob; ?>"></td>
</tr>
</tbody>
</table>
<p><input type='submit' value='����������'></p>
</form>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////

define("RAILROAD_RATIO",0.5);
define("AUTOROAD_RATIO",0.2);

/////////////////����� �������� �� ����///////////////
$i = 0;
while($i++ < 16)
	{
		if ($kg <= 200)
		{
			$kg_res = "minkg";
			break;
		}
		if ($kg >= 30000)
		{
			$kg_res = "kg_30000";
			break;
		}
		if ($kg == $kg_base[$i])
		{
			$kg_res = "kg_".$kg_base[$i];
			break;
		}
		if (($kg > $kg_base[$i]) and ($kg < $kg_base[$i+1]))
		{
			$kg_res = "kg_".$kg_base[$i];
			break;
		}
	}
/////////////////����� �������� �� ������///////////////
$i=0;
while($i++ < 16)
	{
		if ($ob <= 0.4)
		{
			$ob_res = "minkub";
			break;
		}
		if (($ob < 1) and ($ob > 0.4))
		{
		    $ob_res = "kub_0_4";
			break;
		}
		if ($ob > 60)
		{
			$ob_res = "kub_60";
			break;
		}
		if ($ob == $ob_base[$i])
		{
			$ob_res = "kub_".$ob_base[$i];
			break;
		}
		if (($ob > $ob_base[$i]) and ($ob < $ob_base[$i+1]))
		{
			$ob_res = "kub_".$ob_base[$i];
			break;
		}
	}
//////////////////////////////////////////////////////////
////���ר�////////////////////////////////////////////////
//$plotn = $kg/1000/$ob;  //��������� ���������
if ($plotn <> 0)
{
echo "\n��������� - ".$plotn."<br><br>";
}
//////////////////////////////////////////////////////////
//$link = mysql_connect ("localhost", "root", ""); // ������������ � ����
//mysql_select_db("tes"); // �������� ����
$query = 'SELECT VagonType,'.$kg_res.','.$ob_res.' FROM prices WHERE DepartureName="'.$gorod_otkuda.'" AND ArrivalName="'.$gorod_kuda.'"';
$results = mysql_query($query);

$i = 0;
$raschet_1 = true;
while ($line = mysql_fetch_assoc($results)) {
	if ($raschet_1)
	{
	 $raschet_1 = false;
	 echo "<b>������ �� ����</b><br>";
	}
	if ($kg_res == "minkg")
	 {
	 echo "��� ��������� - " . $line["VagonType"] . "\n<br>";
	 $mass_vagontype[$i] = $line["VagonType"];
	 echo "����������� ��������� - " . $line[$kg_res] . "\n<br>";
	 $cena_mass_kg[$i] = $line[$kg_res];
	 $i++;
	 }
	else
	 {
	 echo "��� ��������� - " . $line["VagonType"] . "\n<br>";
	 $mass_vagontype[$i] = $line["VagonType"];
	 echo "���� �� �� - " . $line[$kg_res] . "\n<br>";
	 echo "������ ��������� = ".ceil($line[$kg_res]*$kg)."\n<br>";
	 $cena_mass_kg[$i] = ceil($line[$kg_res]*$kg);
	 $i++;
	 }
 }
 
$i = 0;
$raschet_2 = true;
$query = 'SELECT VagonType,'.$ob_res.' FROM prices WHERE DepartureName="'.$gorod_otkuda.'" AND ArrivalName="'.$gorod_kuda.'"';
$results = mysql_query($query);
while ($line = mysql_fetch_assoc($results)) {
	if ($raschet_2)
	{
	 $raschet_2 = false;
	 echo "<br><b>������ �� ������</b><br>";
	}
	if ($ob_res == "minkub")
	 {
		echo "��� ��������� - " . $line["VagonType"] . "\n<br>";
		echo "����������� ��������� - " . $line[$ob_res] . "\n<br>";
		$cena_mass_ob[$i] = $line[$ob_res];
		$i++;		
	 }
	else
	 {
		echo "��� ��������� - " . $line["VagonType"] . "\n<br>";
		echo "���� �� �3 - " . $line[$ob_res] . "\n<br>"; 
		echo "������ ��������� = ".ceil($line[$ob_res]*$ob)."\n<br>";
		$cena_mass_ob[$i] = ceil($line[$ob_res]*$ob);
		$i++;
	 }
 }

//print_r($cena_mass_ob);
mysql_close($link);
///////////////////////////////////////////////////////////////////

$j = 0;
$i = 0;
$end_cena = false;
for($i = 0; $i < sizeof($cena_mass_ob); ++$i)
{
    if ($cena_mass_kg[$i] > $cena_mass_ob[$i])
 {
	$cena_itog[$j] = $cena_mass_kg[$i];
	$j++;
 }
 else
 {
	$cena_itog[$j] = $cena_mass_ob[$i];
	$j++;
 }
 $end_cena = true;
}
if ($end_cena)
{
echo "<br><b><u>�����(��������):</u></b>";
}
//print_r($cena_itog);

for($i = 0; $i < sizeof($cena_itog); ++$i)
{
echo '<br>���� ��������� <u>'.$mass_vagontype[$i].'</u> - '.$cena_itog[$i];
}
//////////////////////////////////////////////////////////////////////
/*
$j = 0;
for($i = 0; $i < sizeof($cena_mass_ob); ++$i)
{
    if ($plotn < RAILROAD_RATIO)
 {
	$cena_itog_plotn[$j] = $cena_mass_ob[$i];
	$j++;
 }
 else
 {
	$cena_itog_plotn[$j] = $cena_mass_kg[$i];
	$j++;
 }
}
*/
//echo "<br><b><u>�����:</u></b><br>";
//print_r($cena_itog_plotn);

?>