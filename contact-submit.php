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

	$firstname = $_POST['cname'];
	$telephone = $_POST['cphone'];
	$email = $_POST['cemail'];
	$message = $_POST['cmessage'];

	$mail_content = "<table>
		<tr>
			<td>Full name:</td>
			<td>$firstname</td>
		</tr>
		<tr>
			<td>Phone number:</td>
			<td>$telephone</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>$email</td>
		</tr>
		<tr>
			<td>Message:</td>
			<td>$message</td>
		</tr>
	</table>";

	$subject = "Contact Request";
    $to='info@test.com';
 	$from='info@test.com';
	$header  = "From: Socal Moving Company <$from>\r\n"; 
    $header .= "Content-type: text/html\r\n";

	mail($to, $subject, $mail_content, $header);
	// header("Location: thankyou.php");
	echo json_encode(array('success' => 'true','url'=>'thankyou.php'));
    
	
} else {

    echo json_encode(array('success' => 'false'));
  }



?>