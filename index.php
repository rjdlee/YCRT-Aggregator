<!DOCTYPE XHTML Basic 1.1>
<html>
	<head>
		<title>YCRT Aggregator</title>
		<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/> 
		<link href="main.css" rel="stylesheet"/>
	</head>
	<body>
		
		<div class="navbar navbar-fixed-top">
			<div id="navCust" class="navbar-inner">
				<a class="brand" href="http://rileedesign.com/"><img src="img/logo.svg" width="52.5" height="32.5" alt="Logo"/></a>
			</div>
		</div>

		<?php

		$output = '<span><h1>Hacker News</h1>';
		$jsonYC = file_get_contents('http://api.ihackernews.com/page');
		$getYC = json_decode($jsonYC, true);

		if($jsonYC) foreach ($getYC['items'] as $key => $post) {
			$url = str_replace('/comments/', 'https://news.ycombinator.com/item?id=', $post['url']);
			$output .= formLink($url, $post['points'], $post['title'], $post['commentCount'], 'https://news.ycombinator.com/item?id='.$post['id']);
		} else
			$output .= '<div class="error">Unable to load Hacker News.</div>';

		$output .= '</span><span><h1>Reddit Technology</h1>';

		$jsonRD = file_get_contents('http://www.reddit.com/r/technology/.json');
		$getRD = json_decode($jsonRD, true);

		if($jsonRD) foreach ($getRD['data']['children'] as $key => $post)
			$output .= formLink($post['data']['url'], $post['data']['score'], $post['data']['title'], $post['data']['num_comments'], 'http://reddit.com'.$post['data']['permalink']);
		else
			$output .= 'div class="error">Unable to load Reddit Technology.</div>';

		$output .= '</span>';
		utf8_encode($output);
		echo $output;

		function formLink($url, $points, $title, $numComments, $comments) {
			$formatPoints = $points;

			if(strlen($points) < 4) {
				for($i = 0; $i < 5 - (strlen($points)); $i++) {
					$formatPoints = '&nbsp' . $formatPoints;
				}
			}

			return '<div class="post"><div><bdi>'.$formatPoints.'</bdi></div><div><a href="'.$url.'" target="_blank" style="target-new: tab;">'.$title.'</a>
			<br/><br/><a href="'.$comments.'" target="_blank" style="target-new: tab;">'.$numComments.' comments</a></div></div>';
		}

		?>
	</body>
</html>