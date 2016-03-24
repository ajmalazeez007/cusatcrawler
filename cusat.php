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

		$Mail = new PHPMailer();
  $Mail->IsSMTP(); // Use SMTP
  
  $Mail->Host        = "smtp.gmail.com"; // Sets SMTP server
  $Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
  $Mail->SMTPAuth    = TRUE; // enable SMTP authentication
  $Mail->SMTPSecure  = "ssl"; //Secure conection
  $Mail->Port        = 465; // set the SMTP port
  $Mail->Username    = 'cusatcrawler@gmail.com'; // SMTP account username
  $Mail->Password    = 'asd123##'; // SMTP account password
  $Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
  $Mail->CharSet     = 'UTF-8';
  $Mail->Encoding    = '8bit';
  $Mail->Subject     = 'New Cusat notification';
  $Mail->ContentType = 'text/html; charset=utf-8\r\n';
  $Mail->From        = 'cusatcrawler@gmail.com';
  $Mail->FromName    = 'Cusat Crawler';
  $Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line

  $Mail->AddAddress('ajmalazeez007@gmail.com'); // To:
  $Mail->isHTML( TRUE );
  $Mail->Body    = 'New notification <br> <b>$inner </b>';
  $Mail->AltBody = '$inner';
  $Mail->Send();
  $Mail->SmtpClose();

  if ( $Mail->IsError() ) { // ADDED - This error checking was missing
    echo "false";
  }
  else {
    echo "true";
  }

}
}


	



  

  
       	
          
 ?>