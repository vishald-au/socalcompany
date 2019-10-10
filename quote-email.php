<?php
$captcha;

  $captcha = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
  if(!$captcha){
    echo '<h2>Please check the the captcha form.</h2>';
    exit;
  }
  $secretKey = "";
  $ip = $_SERVER['REMOTE_ADDR'];

  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = array('secret' => $secretKey, 'response' => $captcha);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $response = file_get_contents($url, false, $context);
  $responseKeys = json_decode($response,true);
  header('Content-type: application/json');
  if($responseKeys["success"]) {

$fields = array(
	'from' => $_POST['from'],
	'to' => $_POST['to'],
	'size_of_move' => $_POST['size_of_move'],
	'date_of_move' => $_POST['date_of_move'],
	'first_name' => $_POST['first_name'],
	'last_name' => $_POST['last_name'],
	'phone' => $_POST['phone'],
	'email' => $_POST['email'],
	'booked_from' => 000
	);

$url = ""; 

foreach($fields as $key=>$value) { 
	$fields_string .= $key.'='.$value.'&'; 
}
$fields_string = substr($fields_string, 0, -1);

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

if (curl_exec($ch)) {
				//header("Location: thankyou.php");
				echo json_encode(array('success' => 'true','url'=>'thankyou.php'));
			}

			if(curl_errno($ch))
			{
				// echo '<br/>error:' . curl_error($ch);
				echo json_encode(array('success' => false));
			}

			curl_close($ch);
			} else {

    echo json_encode(array('success' => false));
  }
?>