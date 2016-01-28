<?php
//Script php : Extraction urls Résultats Google
// Copyrights 2008 Seoblackout.com
//http://www.seoblackout.com	
//Url script : http://www.seoblackout.com/2008/10/26/extraire-resultats-google/
 
@set_time_limit(0);
$useragent='Mozilla/5.0';
$regex='<h3 class="r">';
//extension et langue google
if ((isset($_POST['ext'])) && ($_POST['ext']!='')) 
{
	$ext=strip_tags($_POST['ext']);
	if ($ext=='fr') {
	$lang='fr';
	}
	else if ($ext=='com') {
	$lang='en';
	} 
	else if ($ext=='es') {
	$lang='es';
	}
	else if ($ext=='de') {
	$lang='de';
	}
	else if ($ext=='ca') {
	$lang='en';
	}
	else if ($ext=='ca2') {
	$ext='ca';
	$lang='fr';
	}
	else {
	$ext='fr';
	$lang='fr';
	}
}
else 
{
	// par défaut, on recherche sur google.fr et lang=fr
	$ext='fr';
	$lang='fr';
}
//nombre de page à extraire :
if ((is_numeric($_POST['pages'])) && ($_POST['pages']!='')) 
{
	$c=(strip_tags($_POST['pages'])-1);
}
else 
{
	//10 pages par défaut, on part de 0 donc 10 pages = 9
	$c=9;
}
 
if ((isset($_POST['kw'])) && ($_POST['kw']!='')) 
{
	$kw=trim(strip_tags($_POST['kw']));
	$pagenum = 0;			
	$googlefrurl = "http://www.google.".$ext."/search?hl=".$lang."&q=" . urlencode($kw) . "&start=$pagenum";
	$url_new = '';
 
	while($pagenum <= $c) 
	{
			if (function_exists('curl_init')) 
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_USERAGENT, $GLOBALS['useragent']);
				curl_setopt($ch, CURLOPT_URL,$googlefrurl);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				$result=curl_exec ($ch);
				curl_close ($ch);
			} 
			else 
			{
				$result= file_get_contents($googlefrurl);
			} 	
		preg_match_all('/'.$regex.'<a href="(.*?)"/si', $result, $matches);
			$i = 0;
			$n = count($matches[1]);
			$pagenum++;
			$pagenum2 = $pagenum.'0';
			$googlefrurl = "http://www.google.".$ext."/search?hl=".$lang."&q=" . urlencode($kw) . "&start=$pagenum2&safe=off&pwst=1&filter=0";
 
			while($i <= $n) 
			{
				$url_new1 = addslashes($matches[1][$i]);
				$url_new .= trim($matches[1][$i])."<br>";
				$i++;
				flush();
			}
	}
	$url_new .= '';				
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Extraction Urls résultats Google</title>
	
	</head>

	<body>
		<h1>Extraction Urls résultats Google</h1>
			<div>
				<?php 
				if ((isset($_POST['kw'])) && ($_POST['kw']!='')) {
					echo "<h3>Keyword : ",strip_tags($kw),"</h3>";
					echo "<h6>Google Results</h6>";
					echo str_replace('<br><br>','<br>',$url_new); 
				}
				?>
			<form method="POST" action="<?php echo strip_tags($_SERVER['REQUEST_URI']) ;?>">
				<p>Saisir vos mots-clés :</p>

				<input name="kw" type="text" size="100" value="<?php if (isset($_POST['kw'])) {echo strip_tags($kw);} ?>">

				<p>Nombre de pages à extraire (optionel => 10 pages par défaut):</p>

				<input name="pages" type="text" size="3" maxlength="3" value="<?php if (isset($_POST['pages'])) {echo strip_tags($_POST['pages']);} else {echo '10';} ?>">

				<p>Moteur :</p>

				<select name="ext">
					<option value="fr"<?php if (($_POST['ext'])=='fr') {echo ' selected';} ?>>Google.fr (hl=fr)</option>
					<option value="com"<?php if (($_POST['ext'])=='com') {echo ' selected';} ?>>Google.com (hl=en)</option>
					<option value="es"<?php if (($_POST['ext'])=='es') {echo ' selected';} ?>>Google.es (hl=es)</option>
					<option value="de"<?php if (($_POST['ext'])=='de') {echo ' selected';} ?>>Google.de (hl=de)</option>
					<option value="ca"<?php if (($_POST['ext'])=='ca') {echo ' selected';} ?>>Google.ca (hl=en)</option>
					<option value="ca2"<?php if (($_POST['ext'])=='ca2') {echo ' selected';} ?>>Google.ca (hl=fr)</option>
				</select>

				<input type="submit" value="Go" name="go">

				<input type='button' value='Annuler' onclick='location.href="<?php echo strip_tags($_SERVER['REQUEST_URI']) ;?>"'>
			</form>
			<br />
			</div>
	</body>
</html>