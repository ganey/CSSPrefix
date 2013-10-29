<?php

$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : false;
$css = isset($_POST['css']) ? $_POST['css'] : false;

$prefixedCss = '';

if ($prefix && $css) {
	$parts = explode('}', $css);
	foreach ($parts as &$part) {
		if (empty($part)) {
			continue;
		}

		$subParts = explode(',', $part);
		foreach ($subParts as &$subPart) {
			$subPart = $prefix . ' ' . trim($subPart);
		}

		$part = implode(', ', $subParts);
	}

	$prefixedCss = implode("}\n", $parts);	
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Online CSS Prefixer (free)</title>
</head>
<body>
	<form action="index.php" method="post">
		<label for="prefix">Prefix (#some_id or .some_class)</label><br />
		<input type="text" name="prefix" id="prefix" value="" />
		<br />
		<br />
		<label for="css">Copy/paste stylesheet below</label><br />
		<textarea name="css" id="css" cols="80" rows="100"></textarea>
		<br />
		<br />
		<input type="submit" value="Get your prefixed CSS!" />
	</form>
	<textarea cols="80" rows="100"><?php echo $prefixedCss ?></textarea>
</body>
</html>