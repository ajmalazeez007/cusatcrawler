<?php 
// Create DOM from URL or file
include('Simplehtmldom/simple_html_dom.php');
require 'PHPMailer/PHPMailerAutoload.php';

$html = file_get_html('http://exam.cusat.ac.in/');

// Find all images 
// foreach($html->find('img') as $element) 
//        echo $element->src . '<br>';

// Find all links 

$con = mysqli_connect('localhost','root','asd123##','cusat') or die('Couldnt connect');


foreach($html->find('a') as $element) {
	//echo $element->href . '<br>';
	$inner=strip_tags($element->innertext);
	//sendMail('test');
	$query = "INSERT INTO `innertext`(`inner`) VALUES ('$inner')";

	mysqli_query($con,$query);

	if (mysqli_affected_rows($con)==1) {
		echo "<br> Inserted ".$inner;


require_once "Mail.php";

$from     = "cusatcrawler@gmail.com";
$to       = "ajmalazeez007@gmail.com";
$subject  = "Test email using PHP SMTP with SSL\r\n\r\n";
$body     = "This is a test email message";
$host     = "smtp.gmail.com";
$port     = "465";
$username = "cusatcrawler@gmail.com";
$password = "asd123##";
$headers  = array(
    'From' => "cusatcrawler@gmail.com",
    'To' => $to,
    'Subject' => $subject
);
$smtp     = Mail::factory('smtp', array(
    'host' => $host,
    'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password
));
$mail     = $smtp->send($to, $headers, $body);
if (PEAR::isError($mail)) {
    echo ("Error
" . $mail->getMessage() . "

");
} else {
    echo ("
Message successfully sent!

");
}

	}


}
  

  
       	
          
 ?>