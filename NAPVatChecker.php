<?php
	// TAKE COOKIE
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_VERBOSE => 1,
	    CURLOPT_HEADER => 1,
	    CURLOPT_URL => 'https://inetdec.nra.bg/pls/pub/login_anonymous.home?caller=home.magic'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);

	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($resp, 0, $header_size);
	$body = substr($resp, $header_size);

	// echo "<pre>";
	// print_r($header);
	// echo "</pre>";

	$re = "/Set-Cookie: (.*);/";
	preg_match($re, $header, $cookie);

	$re = "/(.*)=(.*)/";
	preg_match($re, $cookie[1], $cookieSplit);

	// DISPLAY COOKIE
	// echo "<pre>";
	// print_r($cookieSplit);
	// echo "</pre>";

	// Close request to clear up some resources
	curl_close($curl);

	// SELECT SERVICE TO OPEN
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_VERBOSE => 1,
	    CURLOPT_HEADER => 1,
	    CURLOPT_URL => 'https://inetdec.nra.bg/pls/pub/home.selectService?system_id=6&service_id=8'
	));
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"Accept:*/*",
			"Accept-Encoding:gzip, deflate, sdch, br",
			"Accept-Language:bg,en;q=0.8,ru;q=0.6,en-US;q=0.4,de;q=0.2,mk;q=0.2,ro;q=0.2",
			"Cache-Control:no-cache",
			"Connection:keep-alive",
			"Cookie:" . $cookieSplit[0],
			"DNT:1",
			"Host:inetdec.nra.bg",
			"Pragma:no-cache",
			"Referer:https://inetdec.nra.bg/pls/pub/home.html",
			"User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36"
    	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);

	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($resp, 0, $header_size);
	$body = substr($resp, $header_size);

	// echo "<pre>";
	// print_r($header);
	// echo "</pre>";
	// echo "<pre>";
	// print_r(mb_convert_encoding($body, 'utf-8', 'windows-1251'));
	// echo "</pre>";

	// Close request to clear up some resources
	curl_close($curl);


	// LOGIN STATUS
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_VERBOSE => 1,
	    CURLOPT_HEADER => 1,
	    CURLOPT_URL => 'https://inetdec.nra.bg/pls/pub/login.status'
	));
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"Accept:*/*",
			"Accept-Encoding:gzip, deflate, sdch, br",
			"Accept-Language:bg,en;q=0.8,ru;q=0.6,en-US;q=0.4,de;q=0.2,mk;q=0.2,ro;q=0.2",
			"Cache-Control:no-cache",
			"Connection:keep-alive",
			"Cookie:" . $cookieSplit[0],
			"DNT:1",
			"Host:inetdec.nra.bg",
			"Pragma:no-cache",
			"Referer:https://inetdec.nra.bg/pls/pub/home.html",
			"User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36"
    	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);

	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($resp, 0, $header_size);
	$body = substr($resp, $header_size);

	// echo "<pre>";
	// print_r($header);
	// echo "</pre>";
	// echo "<pre>";
	// print_r(mb_convert_encoding($body, 'utf-8', 'windows-1251'));
	// echo "</pre>";

	// Close request to clear up some resources
	curl_close($curl);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Провери идентификационен номер</title>
</head>
<body>
<?php 
if (!empty($_GET['code'])) {
	$ch = curl_init("https://inetdec.nra.bg/pls/pub/rep.Vatquery.report");

    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
            "ipID=" . $_GET['code'] . "&ipID_Type=0");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		"Cookie: " . $cookieSplit[0],
    		// "Cookie: ISPUBSESSION=84478:EWYXG4S3Z24X421V2LA7X3PZVBH29IEZHNBQDAT2B3JQ24RC6IYUQ2MA8GZQM73H",
    		"Content-Type: application/x-www-form-urlencoded"
    	));
    curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $page = curl_exec($ch);
    $head = curl_getinfo($ch, CURLINFO_HEADER_OUT);
    // echo "<pre>";
    // print_r($head);
    // echo "</pre>";
    // echo "<pre>";
    // print_r(mb_convert_encoding($page, 'utf-8', 'windows-1251'));
    // echo "</pre>";

    $page = htmlspecialchars(mb_convert_encoding($page, 'utf-8', 'windows-1251'));

    // echo "<pre>";
    // print_r(var_dump($page));
    // echo "</pre>";

    $re = "/rowspan=(1|2)&gt;(.*?)&lt;/";
	preg_match_all($re, $page, $matches);

	// echo "<pre>";
	// print_r($matches[1]);
	// echo "</pre>";

	echo "<h1>Проверка на данни директно от страницата на НАП:</h1>";
	if (!empty($matches[0])) {
		foreach ($matches[2] as $v) {
			echo "<h2>" . $v . "</h2>";
		}
	} else {
		echo "<h2>Няма намерена регистрирана фирма с този идентификационен номер</h2>";
	}

    curl_close($ch);
}
 ?>
</body>
</html>
