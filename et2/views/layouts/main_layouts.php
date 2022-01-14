<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo ET2_PATH_HTML;?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ET2_PATH_HTML;?>/css/main.css" />
	<title>et2</title>
</head>

<body>
	<div class="main_conteiner">
		<div class="menu">
			<ul>
				<li><a href="/et2/">Главная</a></li>
				<li><a href="/et2/configlist/">Список настроек</a></li>
				<li><a href="/et2/category/?id=1">Категория 1</a></li>
				<li><?php echo ET2_PATH; ?></li>
				<li><?php echo ET2_PATH_ET2; ?></li>

			</ul>
		</div>
		
		<?php
			include ($contentPage);
		?>
        <hr>
		<?php
		//echo $sitePath;
		?>
		
	</div>
</body>
</html>