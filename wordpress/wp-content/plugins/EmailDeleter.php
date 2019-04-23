<?php
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
function delete_emails($mailbox, $user, $password, $emails, $selector)
{
	$inbox = imap_open($mailbox, $user, $password);

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
		imap_delete($inbox, $emails_to_delete[$j]);
	}

	imap_expunge($inbox);
	imap_close($inbox);
	
	return $emails_to_delete;
}
?>