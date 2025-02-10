<?php

$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : '';
$css = isset($_POST['css']) ? $_POST['css'] : '';
$spacer = isset($_POST['spacer']) ? $_POST['spacer'] : '';
$lines = 10;

$prefixedCss = '';

if ($prefix && $css) {
	$parts = explode('}', $css);
	foreach ($parts as &$part) {
		if (empty($part)) {
			continue;
		}

		$comments = explode("*/", $part);
		foreach ($comments as &$comment) {

			$subParts = explode(',', $comment);
			foreach ($subParts as &$subPart) {
				// vérifier que c'est une classe ou un id
				//echo $subPart.' => '.substr(trim($subPart), 0, 1).'<br>';
				if (substr(trim($subPart), 0, 1) == '.') {
					$subPart = $prefix . $spacer . ($subPart);
				}

				elseif (substr(trim($subPart), 0, 1) == '#') {
					//echo $subPart.' => '.substr(trim($subPart), 0, 1).'<br>';
					//echo '----> '.substr(trim($subPart), 0, 7).'<br>';
					// vérifier que ce n'est pas une couleur
					if (!preg_match('/^#[a-f0-9]{6}$/i', substr(($subPart), 0, 7))) {
						//echo 'couleur : '.$subPart.'<br><br>';
						$subPart = $prefix . $spacer . ($subPart);
					}
				}

				else {
					$subPart = $prefix . $spacer . ($subPart);
				}
			}
			$comment = implode(', ', $subParts);
		}

		$part = implode("*/\n", $comments);
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
					<li class="active"><a href="/">Home</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">

		<div class="starter-template">
			<h1>Batch add any prefix to your CSS rules and class names!</h1>
			<p class="lead">Turn this: <code>body, a, #wrapper, div.block {...</code></p>
			<p class="lead">into this: <code>#prefix body, #prefix a, #prefix #wrapper, #prefix div.block {...</code></p>
		</div>

		<form role="form" action="/" method="post">
			<div class="form-group">
				<label for="prefix">Prefix:</label><br>
				<input type="text" name="prefix" id="prefix" placeholder="#some_id or .some_class" class="form-control input-lg" value="<?php echo $prefix ?>" />
			</div>
			<div class="form-group">
				<label for="spacer">Spacer:</label><br>
				<input type="text" name="spacer" id="spacer" placeholder="space or dash or underscore or nothing" class="form-control input-lg" value="<?php echo $spacer ?>" />
			</div>

			<div class="form-group">
				<label for="css">Copy/paste stylesheet below:</label><br>
				<textarea name="css" id="css" cols="80" rows="10" class="form-control input-lg" placeholder="#id, .class { margin: 0; padding: 0; }"><?php echo $css ?></textarea>
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
		<!-- GitHub Watch -->
		<a class="github-button" href="https://github.com/ganey/CSSPrefix" data-icon="octicon-eye" data-style="mega" aria-label="Watch italic/CSSPrefix on GitHub">Watch</a>
		<!-- GitHub Star -->
		<a class="github-button" href="https://github.com/ganey/CSSPrefix" data-icon="octicon-star" data-style="mega" aria-label="Star italic/CSSPrefix on GitHub">Star</a>
		<!-- GitHub Fork -->
		<a class="github-button" href="https://github.com/ganey/CSSPrefix/fork" data-icon="octicon-repo-forked" data-style="mega" aria-label="Fork italic/CSSPrefix on GitHub">Fork</a>
		<!-- GitHub Issue -->
		<a class="github-button" href="https://github.com/ganey/CSSPrefix/issues" data-icon="octicon-issue-opened" data-style="mega" aria-label="Issue italic/CSSPrefix on GitHub">Issue</a>
		<br>
		<br>
		<small>Updated from original at <a href="https://github.com/italic/CSSPrefix" target="_blank"><em>italic</em></a></small>
		<br>
		<br>
	</div><!-- /.container -->

	<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>

	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-79VJ3RMRBG"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-79VJ3RMRBG');
</script>

</body>
</html>
