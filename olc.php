<!DOCTYPE XHTML Basic 1.1>
<html>
	<head>
		<title>OLC</title>
	</head>
	<body>

	<?php
		$url = 'https://olc.lcs.on.ca/';
		$olc = file_get_contents($url);

		if($olc)
		//	echo $url . '</br>' . $olc;
		else
			//echo $url . '<br/>Failure!';

		$ch = curl_init($url);
		//echo curl_exec($ch);
		curl_close($ch);
	?>

	</body>
</html>