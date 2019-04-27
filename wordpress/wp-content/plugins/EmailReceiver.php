<?php
include_once "Net/POP3.php";

/*
 * Storing the information of an email.
 */
class Email
{
	var $from;
	var $to;
	var $subject;
	var $date;
	var $body;

	function __construct($from, $to, $subject, $date, $body)
	{
		$this->from = $from;
		$this->to = $to;
		$this->subject = $subject;
		$this->date = $date;
		$this->body = $body;
	}

	function get_from()
	{
		return $this->from;
	}

	function get_to()
	{
		return $this->to;
	}

	function get_subject()
	{
		return $this->subject;
	}

	function get_date()
	{
		return $this->date;
	}

	function get_body()
	{
		return $this->body;
	}
}

/*
 * Receive all the emails in the inbox.
 *
 * $host: String
 * $port: String
 * $user: String
 * $password: String
 * 
 * example:
 * $host='localhost'; $port='110';
 * $user='richard'; $password='Alien3';
 *
 * return: An Array of Email Object
 */
function receive_all_emails($host, $port, $user, $password)
{
	$pop3 =& new Net_POP3();
	$pop3->connect($host, $port);
	$pop3->login($user, $password);
	$numbers = $pop3->getNumMsg();

	$emails = array();
	for ($i = 1; $i <= $numbers; $i++)
	{
	    $header = $pop3->getRawHeaders($i);
		$lines = get_lines($header);

		$from = parse_from($lines);
		$to = parse_to($lines);
		$subject = parse_subject($lines);
		$date = parse_date($lines);

		$body = $pop3->getBody($i); // You may define other decoding ways here.
		$email = new Email($from, $to, $subject, $date, $body);
	    array_push($emails, $email);
	}

	$pop3->disconnect();
	return $emails;
}

/*
 * Split a string by line breaks.
 *
 * $str: String
 *
 * return: Array of String, lines of the input string.
 */
function get_lines($str)
{
	return explode("\n", $str);
}

/*
 * Parse an element of an email from its lines of the content.
 *
 * $lines: An Array of String
 *
 * return: String, the element of the email. Return an empty string if failed.
 */
function parse_element($lines, $start)
{
	foreach($lines as $line)
	{
		if(starts_with($line, $start))
		{
			return substr($line, strlen($start));
		}
	}
	return "";
}

/*
 * Parse the sender of an email from its lines of the content.
 *
 * $lines: An Array of String
 *
 * return: String, the sender of the email. Return an empty string if failed.
 */
function parse_from($lines)
{
	return parse_element($lines, "From: ");
}

/*
 * Parse the receiver of an email from its lines of the content.
 *
 * $lines: An Array of String
 *
 * return: String, the receiver of the email. Return an empty string if failed.
 */
function parse_to($lines)
{
	return parse_element($lines, "To: ");
}

/*
 * Parse the subject of an email from its lines of the content.
 *
 * $lines: An Array of String
 *
 * return: String, the subject of the email. Return an empty string if failed.
 */
function parse_subject($lines)
{
	return parse_element($lines, "Subject: ");
}

/*
 * Parse the date of an email from its lines of the content.
 *
 * $lines: An Array of String
 *
 * return: String, the date of the email. Return an empty string if failed.
 */
function parse_date($lines)
{
	return parse_element($lines, "Date: ");
}

/*
 * Check whether a given string is start with another string.
 *
 * $str: String, input string
 * $start: String, start string
 *
 * return: boolean, true if the given string starts with another string.
 */
function starts_with($str, $start)
{
    $len = strlen($start);
	$sub = substr($str, 0, $len);
	return $sub === $start;
}
?>
