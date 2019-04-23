<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

/*
 * Storing the address and name for each receiver.
 * In our situation, usually the receivers are our users.
 */
class Receiver
{
	var $address;
	var $name;

	function __construct($address, $name)
	{
		$this->address = $address;
		$this->name = $name;
	}

	function get_address()
	{
		return $this->address;
	}

	function get_name()
	{
		return $this->name;
	}
}

/*
 * Send an email to user(s) with SMTP.
 *
 * $host: the host of the SMTP service.
 * $user: the email address of the sender.
 * $password: the password of the sender.
 * $username: the sender's name displayed in the email.
 * $receivers: an array of 'Receiver' objects.
 * $subject: the subject of the email.
 * $body: the body of the email, which is in HTML format.
 * $alternativeBody: alternative body of the email for receivers who do not have HTML support.
 *
 * return: there is no return value.
 * exception: if there is any error occurs in the sending of the email, an 'Exception' will be thrown.
 */
function send_email($host, $user, $password, $username, $receivers,
	$subject, $body, $alternativeBody)
{
	$email = new PHPMailer();

	$email->isSMTP();
	$email->SMTPAuth = true;
	$email->SMTPSecure = "tls";
	$email->Host = $host;
	$email->Username = $user;
	$email->Password = $password;
	$email->Port = 587;
	$email->isHTML(true);

	$email->From = $user;
	$email->FromName = $username;
	$email->Subject = $subject;
	$email->Body = $body;
	$email->AltBody = $alternativeBody;

	foreach ($receivers as $receiver)
	{
		$email->addAddress($receiver->get_address(), $receiver->get_name());
	}

	if (!$email->send()) {
		throw new Exception($email->ErrorInfo);
	}
}
?>
