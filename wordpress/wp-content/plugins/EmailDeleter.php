<?php
include_once "Net/POP3.php";
/*
 * Delete all the emails selected by given criteria.
 *
 * $mailbox: String
 * $user: String
 * $password: String
 * $emails: an array of 'Email' objects.
 * $selector: a function used for identify the emails to delete.
 *
 * return: deleted emails' numbers.
 */
function delete_emails($host, $port, $user, $password, $emails, $selector)
{
	$pop3 =& new Net_POP3();
	$pop3->connect($host, $port);
	$pop3->login($user, $password);

	$numbers = count($emails);
	$emails_to_delete = Array();

	for($i = 1; $i <= $numbers; $i++)
	{
		if($selector($emails[$i - 1]))
		{
			array_push($emails_to_delete, $i);
		}
	}

	for($j = count($emails_to_delete) - 1; $j >= 0; $j--)
	{
		$pop3->deleteMsg($emails_to_delete[$j]);
	}

	$pop3->disconnect();	
	return $emails_to_delete;
}
?>