<?php
/* 
* Author : Mayandi
* Text Validation Example
*/
$txt='';
if (isset($_POST['Submit'])){
	$txt=$_POST['txt'];
	if (isset($_POST['SpecialChars'])) $txt=FilterQuery($txt,'SpecialChars');
	if (isset($_POST['realescape'])) $txt=FilterQuery($txt,'realescape','localhost','root','');
	if (isset($_POST['sqlwords'])) $txt=FilterQuery($txt,'sqlwords');
	if (isset($_POST['htmlchars'])) $txt=FilterQuery($txt,'htmlchars');
	if (isset($_POST['urle'])) $txt=FilterQuery($txt,'urle');
	if (isset($_POST['b64e'])) $txt=FilterQuery($txt,'b64e');
	if (isset($_POST['urld'])) $txt=FilterQuery($txt,'urld');
	if (isset($_POST['b64d'])) $txt=FilterQuery($txt,'b64d');
	if (isset($_POST['custom'])&&$_POST['custom']!="") $txt=FilterQuery($txt,$_POST['custom']);
}

function FilterQuery($query,$unwanted,$host='',$username='',$password=''){
	if ($unwanted=='SpecialChars')
		$query = preg_replace("/[^A-Za-z0-9]/", "", $query);
	elseif ($unwanted=='realescape'){
		$link=mysql_connect($host, $username, $password);
		$query= mysql_real_escape_string($query);}
	elseif ($unwanted=='sqlwords')
		$query= preg_replace("/(WHERE|SELECT|UPDATE|SELECT|INSERT|SET|DROP|FROM|INTO|AND|OR|LIMIT|OFFSET)/i", "", $query);
	elseif ($unwanted=='htmlchars')
		$query=htmlspecialchars($query);
	elseif ($unwanted=='urle')
		$query=urlencode($query); 	
	elseif ($unwanted=='b64e')
		$query=base64_encode($query);
	elseif ($unwanted=='urld')
		$query=urldecode($query); 	
	elseif ($unwanted=='b64d')
		$query=base64_decode($query);
	else{
		$unwanted=explode(',',$unwanted);
		$str='';
		foreach($unwanted as $key)
			$str.=$key.'|';
		$str=substr($str,0,strlen($str)-1);
		$query= preg_replace("/($str)/i", "", $query);}
	return $query;
}
?>

			<form method="post">

<table style="border: 1px solid #000000;width: 456px" align="center">
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;width: 294px; color: #2214B9;border-style: solid;border-width: 1px;"><strong>
		Text</strong></td>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;color: #2214B9;border-style: solid;border-width: 1px; width: 420px;">
				<textarea name="txt" style="width: 235px; height: 71px; font-size: 12pt; font-family: 'times New Roman', Times, serif"><?php echo $txt?></textarea>
		</td>
	</tr>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;width: 294px; color: #2214B9;border-style: solid;border-width: 1px;"><strong>
		Filter</strong></td>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;color: #2214B9;border-style: solid;border-width: 1px; width: 420px;">
			<input name="SpecialChars" style="width: 20px; font-family: 'Times New Roman', Times, serif; font-size: 14pt;" type="checkbox" value="SpecialChars"><span style="font-size: 14pt">Special 
			Characters<br>
			</span><span style="font-size: 15pt">
			<input name="realescape" style="width: 20px;font-family: 'Times New Roman', Times, serif; font-size: 14pt;" type="checkbox" value="realescape"></span><span style="font-size: 14pt">MySQL 
			Real Escape<br>
			</span><span style="font-size: 15pt">
			<input name="sqlwords" type="checkbox" value="sqlwords" style="width: 20px; font-family: 'Times New Roman', Times, serif; font-size: 14pt;"><span style="font-size: 14pt">SQL Words<br>
			</span>
			<input name="htmlchars" style="width: 20px; font-family: 'Times New Roman', Times, serif; font-size: 14pt;" type="checkbox" value="htmlchars"><span style="font-size: 14pt">HTML 
			Characters<br>
			</span>
			<input name="urle" type="checkbox" value="urle" style="width: 20px;font-family: 'Times New Roman', Times, serif; font-size: 14pt"><span style="font-size: 14pt">URL Encode<br>
			</span>
			<input name="urld" type="checkbox" value="urld" style="width: 20px;font-family: 'Times New Roman', Times, serif; font-size: 14pt"><span style="font-size: 14pt">URL Decode<br>
			</span>
			<input name="b64e" type="checkbox" value="b64e" style="width: 20px;font-family: 'Times New Roman', Times, serif; font-size: 14pt"><span style="font-size: 14pt">Base 64 Encode<br>
			</span>
			<input name="b64d" style="width: 20px; font-family: 'Times New Roman', Times, serif; font-size: 14pt;" type="checkbox" value="b64d"><span style="font-size: 14pt">Base 
			64 Decode</span></span></td>
	</tr>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;width: 294px; color: #2214B9;border-style: solid;border-width: 1px;">
		<strong>Custom Words <span style="font-size: 15pt">(Separated by comma)</span></strong></td>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center; color: #2214B9;border-style: solid;border-width: 1px; width: 420px;">
			<input name="custom" style="width: 235px; font-size: 12pt; font-family: 'times New Roman', Times, serif" type="text"></td>
	</tr>
</table>
				<div style="text-align: center">
					<br>
					<input name="Submit" style="width: 85px; height: 34px; font-size: 15pt; font-family: 'times New Roman', Times, serif" type="submit" value="Submit"></div>
</form>
