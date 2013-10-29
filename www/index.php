<?php

$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : '';
$css = isset($_POST['css']) ? $_POST['css'] : '';
$lines = 10;

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
	$lines = substr_count($prefixedCss, "\n");
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="One-click add your own #prefix or .prefix to your stylesheet, for free.">
	<meta name="author" content="www.italic.fr">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	<title>Online prefix CSS rules and class names</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/starter-template.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	 <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
      <![endif]-->
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Free Online CSS Prefixer</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="http://www.italic.fr/contact/" target="_blank">Contact</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">

		<div class="starter-template">
			<h1>Batch add any prefix to your CSS rules and class names!</h1>
			<p class="lead">From this: <code>body, a, #wrapper, div.block {...</code></p>
			<p class="lead">To this: <code>#prefix body, #prefix a, #prefix #wrapper, #prefix div.block {...</code></p>
		</div>

		<form role="form" action="/" method="post">
			<div class="form-group">
				<label for="prefix">Prefix:</label><br>
				<input type="text" name="prefix" id="prefix" placeholder="#some_id or .some_class" class="form-control input-lg" value="<?php echo $prefix ?>" />
			</div>

			<div class="form-group">
				<label for="css">Copy/paste stylesheet below:</label><br>
				<textarea name="css" id="css" cols="80" rows="10" class="form-control input-lg" placeholder="html, body, a, img, p, span, h2 { margin: 0; padding: 0; }"><?php echo $css ?></textarea>
			</div>

			<button type="submit" class="btn btn-primary btn-lg">Run the prefixer!</button>

		</form>

		<br>
		<br>
		<label for="css">Here is your prefixed CSS:</label><br>
		<textarea name="css" id="css" cols="80" rows="<?php echo $lines+10 ?>" class="form-control input-lg"><?php echo $prefixedCss ?></textarea>
		
		<br>
		<br>
		<h1>You’re welcome.</h1>
		<br>
		<br>

	</div><!-- /.container -->


	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>