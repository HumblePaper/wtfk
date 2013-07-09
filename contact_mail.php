<?php
//define the receiver of the email
$to = "ilayabasucres@gmail.com,gokul@effectworks.com";
//define the subject of the email
$subject = "Contacted from scaleupp"; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time())); 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: contact@effectworks.com\r\nReply-To: contact@effectworks.com";
//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\""; 

$messagetoadmin = "Trial request from scaleupp <br/> 
	 Email: ". $_POST['email'] ." <br/> ";


//define the body of the message.
ob_start(); //Turn on output buffering

?>
--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/plain; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

Hello World!!! 
This is simple text email message. 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<?php echo $messagetoadmin ?>

--PHP-alt-<?php echo $random_hash; ?>--
<?
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "<div class='success_msg'>Your request has been successfully sent</div>" : "<div class='error_msg'>Mail failed</div>";
?>