<?php
if($_GET['q']&&$_COOKIE['b']){
	$data = $_GET['q'];
	$p_ = $_GET['p'];
	$data = base64_decode($data);
	$waabac1_ ='http://'.$_SERVER['HTTP_HOST'].'?q=';
	if($p_){
		function getLastEffectiveUrl($url){
			$curl = curl_init($url);
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER  => true,
				CURLOPT_FOLLOWLOCATION  => true,
			));
			$result = curl_exec($curl);
			$redirectUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
			curl_close($curl);
			return $redirectUrl;
		}
		$url = str_replace(',,,','',$data);
		$Url_ = getLastEffectiveUrl($url);
		$parseUrl = parse_url(trim($Url_)); 
		if(isset($parseUrl['host']))
		{
			$p_a0 =$parseUrl['scheme'].'://'.$parseUrl['host'].'/';
		}
		function Farse_Url($ul1,$ul2){
			$p_a1 = parse_url(trim($ul1)); 
			if(!empty($p_a1['scheme'])){
				$p_a2 = $ul1;
			}else{
				$p_a2 = $ul2.$ul1;
			}
			return $p_a2;
		}
		// echo $p_a0;die();
		$dom = new DOMDocument('1.0');
		@$dom->loadHTMLFile($url);
		// echo $data;
		$anchors = $dom->getElementsByTagName('a');
		foreach ($anchors as $element) {
			$href = $element->getAttribute('href');
			$href = $waabac1_.base64_encode(Farse_Url($href,$p_a0)).'&p=1';
			$element->setAttribute('href',$href);
		}
		$anchors = $dom->getElementsByTagName('link');
		foreach ($anchors as $element) {
			$href = $element->getAttribute('href');
			$href = $waabac1_.base64_encode(Farse_Url($href,$p_a0));
			$element->setAttribute('href',$href);
		}
		$anchors = $dom->getElementsByTagName('img');
		foreach ($anchors as $element) {
			$href = $element->getAttribute('src');
			$href = $waabac1_.base64_encode(Farse_Url($href,$p_a0));
			$element->setAttribute('src',$href);
		}
		$anchors = $dom->getElementsByTagName('script');
		foreach ($anchors as $element) {
			$href = $element->getAttribute('src');
			$href = '';
			$element->setAttribute('src',$href);
		}
		$anchors = $dom->getElementsByTagName('input');
		foreach ($anchors as $element) {
			$href = $element->getAttribute('src');
			$href = $waabac1_.base64_encode(Farse_Url($href,$p_a0));
			$element->setAttribute('src',$href);
		}
		// $data = $dom->saveHTML();
		// print_r($data); 
		echo $dom->saveHTML();die();
	}else{
		$data = str_replace(',,,','',$data);
		$data = str_replace(';;00;;','http://abs.twimg.com/sticky/default_profile_images/default_profile.png',$data);
		$data = str_replace(';;0;;','http://abs.twimg.com/sticky/default_profile_images/default_profile_normal.png',$data);
		$data = str_replace(';;1;;','http://pbs.twimg.com/profile_images/',$data);
		$data = str_replace(';;2;;','https://pbs.twimg.com/profile_banners/',$data);
		$data = str_replace(';;3;;','http://pbs.twimg.com/media/',$data);
		$data = str_replace(';;4;;','https://video.twimg.com/tweet_video/',$data);
		$data = str_replace(';;5;;','https://video.twimg.com/amplify_video/',$data);
		$data = str_replace(';;6;;','.mp4',$data);
		$data = str_replace(';;7;;','.jpg',$data);
		$data = str_replace(';;8;;','_normal.jpg',$data);
		$data = str_replace(';;9;;','/web',$data);
		$data = str_replace(';;10;;','/vid/',$data);
		$json = file_get_contents($data);
		$fileSize = strlen($json);
		if(preg_match_all("/[.]jpg/i", $data, $m1)){	
			$myhear='image/jpeg';
			$myhear2 = time().'_.jpg';
		}else if(preg_match_all("/[.]mp4/i", $data, $m1)){	
			$myhear='video/mp4';
			$myhear2 = time().'_.mp4';
		}

		header("Content-Type: ".$myhear);
		header("Content-Length: ".$fileSize);
		header('Content-Disposition: inline; filename="'.$myhear2.'"');
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + (60*60*24*365)) . ' GMT');

		header( 'Cache-Control: max-age=290304000' );
		echo $json;die();
	}
}else if($_GET['b']){
	$duration = time() + (3600 * 24 * 365);
	setcookie('b', '123', $duration, '/');
}else{
	$json = file_get_contents('data.cv');
	echo $json;die();
}




?>
